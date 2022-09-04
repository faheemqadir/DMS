<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\User;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Setting;
use DB;
class ApiController extends Controller
{
    //
    function get_item($id = 0){
     
    
        $aData['items'] = Item::all()->toArray();
        if( count($aData) > 0 ){
            $response=['status'=>1,"msg"=>"data found","data"=> $aData];
        }else{
            $response=['status'=>2,"msg"=>"data not found"];
        }
        return json_encode($response);
    }
    function get_wallet(Request $request){
        
        $iCustomerd = $request->get('customer_id');
        
        if($iCustomerd){

            $iWalletAmount = customer::where('id',$iCustomerd)->pluck('customer_wallet');
            $iOrderLimit = Setting::where('setting_name','credit_limit')->pluck('setting_value');

            if( $iWalletAmount  ){
                $response=['status'=>1,"msg"=>"data found","data"=> ["WalletAmount" => $iWalletAmount[0],"OrderLimit"=>$iOrderLimit[0] ]];
            }else{
                $response=['status'=>2,"msg"=>"data not found"];
            }
        }else{
            $response=['status'=>2,"msg"=>"data not found"];
        }
        
        return json_encode($response);
    }
    function get_user_info(Request $request){
        
        $sNumber= $request->get('mobileNumber');
        
        $sPassword=  $request->get('password');
        $response = [];
        if($sNumber && $sPassword){
            $aData = customer::where('customer_contact',$sNumber)->where('customer_password',$sPassword)->get();
            
            if( count($aData) > 0 ){
                $response=['status'=>1,"msg"=>"Succellfully sign in","data"=> $aData[0]];
            }else{
                $response=['status'=>2,"msg"=>"Invalid username/password"];
            }
        }else{
            $response = ['status'=> 3 , 'msg' => "Invalid username/password" ];    
        }
        return json_encode($response);
    }
    function add_customer(Request $request){
        
        $name     = $request->get('name');
        //$email    = $request->get('mobileNumber');
        $Contact  = $request->get('mobileNumber');
        $Password = $request->get('password');
        $customer_address = $request->get('address');
        
        //$aData = customer::where('customer_contact',$Contact)->get();
        //$aData = count();
        
        $aCustomer = customer::where('customer_contact',$Contact)->first();
        if ($aCustomer === null) {
            
            $Customer = new Customer();
            $Customer->customer_name     = $name;
            //$Customer->customer_email    = $email;
            $Customer->customer_contact  = $Contact;
            $Customer->customer_address  = $customer_address;
            $Customer->customer_password = $Password;
            //$Customer->updated_at = date("Y-m-d H:i:s");
            //$Customer->created_at = date("Y-m-d H:i:s");    
            
            $resp = $Customer->save();
            if($resp){
                $response=['status'=>1,"msg"=>"Registered successfully"];
            }else{
                $response=['status'=>2,"msg"=>"Internal server error"];
            }
        }else{
            $response=['status'=>2,"msg"=>"Mobile number already Exist"];
        }
        return $response;
        
    }
    function add_customer1(){
        
        $name="test";
        $email="test";
        $Contact="test";
        $customer_address="test";
        
        $Customer = new Customer();
        $Customer->customer_name = $name;
        $Customer->customer_email = $email;
        $Customer->customer_contact = $Contact;
        $Customer->customer_address = $customer_address;
        //$Customer->updated_at = date("Y-m-d H:i:s");
        //$Customer->created_at = date("Y-m-d H:i:s");
        
        $resp = $Customer->save();
        if($resp){
            $response=['status'=>1,"msg"=>"data inserted successfully"];
        }else{
            $response=['status'=>2,"msg"=>"Data not inserted"];
        }
        return $response;
        
    }
    function get_item_by_id($id=null){

        $aData = Item::where('id',$id)->get();
        if( count($aData) > 0 ){
            $response=['status'=>1,"msg"=>"data found","data"=> $aData->toArray()];
        }else{
            $response=['status'=>2,"msg"=>"data not found"];
        }
        return json_encode($response);
    }
    function place_order(Request $request){
        
        $dTodayDate =  date('Y-m-d');
        $aData =  $request->get('data');
        $resp = [];

        if($aData){
            $iCustomer_id = $aData['customer_id'];
            
            //$CustWallet = customer::where('id',$iCustomer_id)->first()->customer_wallet;
            //totalAmount

            $CustOrderCount = order::where('customer_id',$iCustomer_id)
            ->where(DB::raw('DATE(order_date)'),$dTodayDate)
            ->where('order_status',0)
            ->count();
            
            if($CustOrderCount == 0){
                
                $isDataInserted = false;
                $iLastId = Order::all()->last();
                
                if( isset($iLastId) ){
                    $iLastId = $iLastId->id;
                }else{
                    $iLastId = 0; 
                }
                $sNextCode = str_pad(($iLastId+1), 4, '0', STR_PAD_LEFT);
                $sOrder_number = ("PKHYD".date("Y").date("m").date("d").$sNextCode);

                DB::transaction(function() use ($aData,&$isDataInserted,$sOrder_number) {
                
                    $dOrderTotalAmount = $aData['totalAmount'];   
                    $iOrderQuantity = $aData['totalQuantity'];   
                    $aOrderItems = $aData['orderItems'];
    
                    
                    $sOrder_total_price = $dOrderTotalAmount;
                    $iShop_id = 1;
                    $iCustomer_id = 1;
                    $iOrder_status = 0;
                    $dOrder_date = date("Y-m-d H:i:s");
                    $sOrder_added_on = date("Y-m-d H:i:s");
    
                    $Order = new Order();
                    
                    $Order->order_number      = $sOrder_number;
                    $Order->order_total_price = $sOrder_total_price;
                    $Order->shop_id           = $iShop_id;
                    $Order->customer_id       = $iCustomer_id;
                    $Order->order_status      = $iOrder_status;
                    $Order->order_date        = $dOrder_date;
                    $Order->order_added_on    = $sOrder_added_on;
    
                    $Order->save();
                    $iOrderId = $Order->id;
    
                    foreach($aOrderItems as $ind=>$values){
                        DB::insert('
                        insert into order_items (order_id , productId ,productPrice,productQuantity) 
                        values ('.$iOrderId.','.$values['productId'].','.$values['totalAmount'].','.$values['totalQuantity'].')');
                    }
                    $isDataInserted = true;
                });

                if($isDataInserted){
                    $resp = ['status'=>1,'msg'=>'order added successfully','order_number'=>$sOrder_number];
                }
            }else{
                $resp = ['status'=>2,'msg'=>'Sorry your Previous is pending you can not proceed new order'];
            }
        }else{
            $resp = ['status'=>2,'msg'=>'unable to prceed order plz try again'];
        }

        echo json_encode($resp);
    }
    function get_order_history(Request $request){
        
        $iCustomerId = $request->get('customer_id');
        
        $aReturnData = [];
        //DB::enableQueryLog();
        $aData = DB::select('
            SELECT 
                O.id,
                O.order_number,
                S.shop_name,
                C.customer_name,
                C.customer_contact,
                U.name,
                O.order_approved_by,
                O.order_status,
                O.order_date,
                O.order_total_price
            FROM 
            orders AS O 
            INNER JOIN customers AS C ON C.id =O.customer_id
            INNER JOIN users AS U ON U.id = O.customer_id
            INNER JOIN shops AS S ON S.id = O.shop_id
            WHERE C.id="'.$iCustomerId.'"
        ');
        //WHERE C.id="'.$iCustId.'"
        foreach($aData as $ind => $val){
           
            $aReturnData[$ind]['Order'] = $val;
            $aData1 = DB::select('
                SELECT
                    I.productId,
                    I.productName,
                    OI.productPrice,
                    OI.productQuantity,
                    I.productScale,
                    I.ProductPurchasePrice
                FROM  order_items AS OI             
                INNER JOIN items AS I ON I.productId =OI.productId
                WHERE
                OI.order_id = "'.$val->id.'"
            ');
            $aReturnData[$ind]['OrderDetail'] = $aData1;
        }
        
        $aResult = [];
        if(count($aReturnData) > 0){
            $aResult=['status'=>1,"data"=>$aReturnData];
        }else{
            $aResult=['status'=>2,"msg"=>"Invalid"];
        }
        
        return json_encode($aResult);
        

    }
    

    ///// Rider App APIs
    function get_rider_info(Request $request){
        
        $sNumber= $request->get('mobileNumber');
        
        $sPassword=  ($request->get('password'));
        
        $aData = user::where('contact',$sNumber)->where('user_type',4)->get();

        $user = User::where('contact', '=', $sNumber)->first();
        //$aData = $aData->toArray();
        // print_r( Hash::check($sPassword, $user->password));
        // die();
        $response = [];
        if($sNumber && $sPassword){
            DB::enableQueryLog();
            
            $aData = user::where('contact',$sNumber)->where('password',$sPassword)->where('user_type',4)->get();
            if( count($aData) > 0 ){
                $response=['status'=>1,"msg"=>"Succellfully sign in","data"=> $aData[0]];
            }else{
                $response=['status'=>2,"msg"=>"Invalid username/password"];
            }
        }else{
            $response = ['status'=> 3 , 'msg' => "Invalid username/password" ];    
        }
        return json_encode($response);
    }
    function get_rider_orders(Request $request){
        
        $iRiderId = $request->get('rider_id');
        
        $aReturnData = [];
        //DB::enableQueryLog();
        $aReturnData['Order'] = DB::select('
            SELECT 
                O.id,
                O.order_number,
                S.shop_name,
                C.customer_name,
                C.customer_contact,
                U.name,
                O.order_approved_by,
                O.order_status,
                O.order_date,
                O.order_total_price
            FROM 
            orders AS O 
            INNER JOIN customers AS C ON C.id =O.customer_id
            INNER JOIN users AS U ON U.id = O.rider_id
            INNER JOIN shops AS S ON S.id = O.shop_id
            WHERE U.id="'.$iRiderId.'"
            Order By id DESC
        ');
        $aResult = [];

        if(count($aReturnData) > 0){
            $aResult=['status'=>1,"data"=>$aReturnData];
        }else{
            $aResult=['status'=>2,"msg"=>"Invalid"];
        }
        
        return json_encode($aResult);
        
    }
    function get_rider_order_detail(Request $request){
        
        //$iRiderId = $request->get('rider_id');
        $iOrderId = $request->get('order_id');
        
        $aReturnData['OrderDetail'] =  DB::select('
            SELECT
                I.productId,
                I.productName,
                OI.productPrice,
                OI.productQuantity,
                I.productScale,
                I.ProductPurchasePrice
            FROM  order_items AS OI             
            INNER JOIN items AS I ON I.productId =OI.productId
            WHERE
            OI.order_id = "'.$iOrderId.'"
        ');
        
        $aResult = [];

        if(count($aReturnData) > 0){
            $aResult=['status'=>1,"data"=>$aReturnData];
        }else{
            $aResult=['status'=>2,"msg"=>"Invalid"];
        }
        
        return json_encode($aResult);
        
    }
    function process_order(Request $request){


        $aResult = [];
        $iOrderId = $request->get('order_id');
        
        $aOrder = order::where('id',$iOrderId)->first();
        
        if($aOrder->count() > 0){
            
            $iCustomer_id = $aOrder->customer_id;
            $iOrderTOtalPrice = $aOrder->order_total_price;
            $dCustomerWallet =   customer::where('id',$iCustomer_id)->first()->customer_wallet;
            $iCollectionLimit = Setting::where('setting_name','rider_collection_limit')->pluck('setting_value');
            
            $dAmountCollect = $iOrderTOtalPrice;
            if($dCustomerWallet > 0){

                if($dCustomerWallet >= $iOrderTOtalPrice){
                    $dAmountCollect = 0;
                }else{
                    $dAmountCollect = ($iOrderTOtalPrice-$dCustomerWallet);
                    //$this->update_customer_wallet($iCustomer_id,(0));
                }
            }
            else{
                $dAmountCollect = $iOrderTOtalPrice;
            }

            $aResult=['status'=>1,"msg"=>"Order details","AmountCollect"=>$dAmountCollect,"CollectionLimit"=>$iCollectionLimit[0]];
        }else{
            $aResult=['status'=>2,"msg"=>"Invalid Order"];
        }
        
        return json_encode($aResult);

    }
    function complete_order(Request $request){
        
        $aResult = [];
        $iOrderId = $request->get('order_id');
        
        
        $iPaymentAmount = 0;
        $iNow           = date("Y-m-d h:i:s");

        $iAddPayment    = $request->get('get_payment');
        
        $iPaymentAmount = $request->get('amount');
        $sOTP_Code      = $request->get('otp_code');

        $aOrder = order::where('id',$iOrderId)->first();

        if($aOrder->count() > 0){

            $iCustomer_id     = $aOrder->customer_id;
            $iOrderTOtalPrice = $aOrder->order_total_price;
            $sCode            = $aOrder->order_otp_code;
            $iRider_id            = $aOrder->rider_id;

            $iOrderStatus            = $aOrder->order_status;

            $dCustomerWallet =   customer::where('id',$iCustomer_id)->first()->customer_wallet;
            if($iOrderStatus == 1){

                if($sOTP_Code){

                    if($sCode == $sOTP_Code){

                        $iRemainingAmount = 0;
                        $iResult = false;
                        //if(!$iPaymentAmount){
                        //}else{

                        $sMsg = "Order failed to complete.contact administrator";
                        if($iPaymentAmount > 0){
                            $iCollectedAmt = 0;
                           
                            if( ($iPaymentAmount+$dCustomerWallet) >=  $iOrderTOtalPrice){
                               
                                if( ($iPaymentAmount+$dCustomerWallet) == $iOrderTOtalPrice ){
                                    $iRemainingAmount = $dCustomerWallet = 0;
                                    $iCollectedAmt = ($iPaymentAmount+$dCustomerWallet);
                                }
                                else if( $iPaymentAmount > $iOrderTOtalPrice ){
                                    $iRemainingAmount = (($iPaymentAmount - $iOrderTOtalPrice));
                                    $iCollectedAmt = ($iPaymentAmount - $iRemainingAmount);
                                    
                                    $dCustomerWallet += $iRemainingAmount; 
                                }
                                if($iCollectedAmt > 0){
                                    $this->update_customer_wallet($iCustomer_id,$dCustomerWallet);
                                    $iResult = order::where('id',$iOrderId)->update([ 'order_collected_amount'=> $iCollectedAmt,'order_status'=> 2]);    
                                }    
                            }else{
                                $sMsg = "Please collect  order remaining amount";
                            }
                        }
                        else{
                            $this->update_customer_wallet($iCustomer_id,($dCustomerWallet-$iOrderTOtalPrice));
                            $iResult =order::where('id',$iOrderId)->update(['order_collected_amount'=>$iOrderTOtalPrice,'order_status'=>2]);
                        }
                        //}
                        if($iResult > 0){

                            DB::table('payment_history')->insert([
                                "customer_id"           => $iCustomer_id     ,
                                "order_id"              => $iOrderId         ,
                                "rider_id"              => $iRider_id        ,
                                "AmountPaid"            => $iPaymentAmount   ,
                                "WalletAmount"          => $dCustomerWallet  ,
                                "PaymentDate"           => $iNow             ,
                                "OrderTotalAmount"      => $iOrderTOtalPrice ,
                                "RemainingWalletAmount" => $iRemainingAmount
                                
                            ]);
                            $aResult=['status'=>1,"msg"=>"Order Completed Successfully"];
                        }else{
                            $aResult=['status'=>2,"msg"=> $sMsg ];
                        }
                    }
                    else{
                        $aResult =["status"=>2,"msg"=>"Invalid Opt Code"];
                    }    
                }else{
                    $aResult =["status"=>2,"msg"=>"please provide OTP code first"];
                }    
            }
            else{
                    $aResult =["status"=>2,"msg"=>"Order already completed"];
            }
        }else{
            $aResult=['status'=>2,"msg"=>"Invalid Order"];
        }
        
        return json_encode($aResult);
        
    }
    function update_customer_wallet($iCustomer_id,$iAmount){

        customer::where('id', $iCustomer_id)->update(['customer_wallet' => $iAmount]);
    }
    function generate_otp_code(Request $request){

        
        $aResult = [];
        $iOrderId = $request->get('order_id');
        $sCode = random_int(1000, 9999);
        
        $aOrder = order::where('id',$iOrderId)->first();

        $aCustomer = customer::where('id',$aOrder->customer_id)->first();
        $sNumber = $aCustomer->customer_contact;

        $iDigit = substr($sNumber,0,2);
        if($iDigit == 92){
            $sNumber = str_replace($iDigit,"",$sNumber);
        }
        $sNumber = '92'.$sNumber;

        $iRes = DB::table('orders')->where('id', $iOrderId )->update(array('order_otp_code' => $sCode));

        if($iRes){

            $apiURL = 'https://bsms.hostandsoft.com/app/sms/api';
            $postInput = [
                'action'  => 'send-sms',
                'api_key' => 'YWxmdXJxYW46MTIzNDU2',
                'to'      => $sNumber,
                'from'    => 'Al Furqan',
                'sms'     => $sCode
                
            ];

            $client = new \GuzzleHttp\Client();
            $response = $client->request('POST', $apiURL, ['form_params' => $postInput]);

            $statusCode = $response->getStatusCode();
            $responseBody = json_decode($response->getBody(), true);

            $aResult=['status'=>1,"msg"=>"OTP code generated successfully","code"=>$sCode];    
        }
        else{
            $aResult=['status'=>2,"msg"=>"OTP code failed to generate"];
        }
        return json_encode($aResult);
    }
    ///// Rider App APIs
    //{"order_id":"1","get_payment":0,"amount":"0","otp_code":1234}
}
