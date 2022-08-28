<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

use App\Models\Item;
use App\Models\User;
use App\Models\Order;
use App\Models\Customer;
use DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    function __construct(){

    }
    function index(){   

        $dToday = date("Y-m-d");
        
        
        /// 0 for new or pending order
        //$sNewOrders = Order::where('order_status', '=', 0)->where(DB::raw('date_format(order_date,"%Y-%m-%d")'),'=',$dToday);
        //$sPendingOrders  = Order::where('order_status', '=', 1)->where(DB::raw('date_format(order_date,"%Y-%m-%d")'),'=',$dToday);
        //$sProcessedOrder = Order::where('order_status', '=', 2)->where(DB::raw('date_format(order_date,"%Y-%m-%d")'),'=',$dToday);

        /*
        $sTotalOrdersCount    = Order::count();
        $sNewOrderCount       = Order::where('order_status', '=', 0);
        $sPendingOrderCount   = Order::where('order_status', '=', 1);
        $sProcessedOrderCount = Order::where('order_status', '=', 2);


        $aData['TotalOrders']     = $sTotalOrdersCount;
        $aData['NewOrdersCount']  = $sNewOrderCount->count();
        $aData['PendingOrdersCount']   = $sPendingOrderCount->count();
        $aData['ProcessedOrdersCount'] = $sProcessedOrderCount->count();
        */
        //for all users
        //$aData['Users'] = User::all()->toArray();
        $aData['Users'] = User::where('user_type','4')->get()->toArray();

        $dToday = date('Y-m-d');
        //$aData['Orders'] = Order::join('customers', 'orders.customer_id', '=', 'customers.id')->get()->toArray();
        //$aData['Orders'] = $this->get_new_order_count($dToday) ;
        $aData['PendingOrders']   = $this->get_assigned_order_count(1,$dToday); 
        $aData['ProcessedOrders'] = $this->get_assigned_order_count(2,$dToday);


        //$aData['ItemsDetail'] = $this->get_items_count($dToday);
            

            
       
        return view('dashboard.index',$aData);   
    }
    function assign_rider(Request $request){

        $iUserId =  $request->get('user_id');
        $iOrderId =  $request->get('order_id');

        $sResult = Order::where('id',$iOrderId)->update(['order_status'=>1,'rider_id'=>$iUserId]);

        $aResult = [];
        if($sResult){
            $aResult=['status'=>1];
        }else{
            $aResult=['status'=>2];
        }
        return json_encode($aResult);
        
    }
    function order_details(Request $request){
        
        $iOrderId =  $request->get('order_id');

        $aData = DB::select('
            SELECT 
                O.id,
                O.order_number,
                O.order_total_price,
                O.order_status,
                C.customer_name,
                I.ProductName,
                OI.productPrice,
                OI.productQuantity
            FROM orders AS O
            INNER JOIN order_items AS OI ON OI.order_id =O.id
            INNER JOIN items AS I ON I.productId =OI.productId
            INNER JOIN customers AS C ON C.id =O.customer_id 
            WHERE
            O.id = "'.$iOrderId .'"
        ');

        $aResult = [];
        if(count($aData) > 0){
            $aResult=['status'=>1,"data"=>$aData];
        }else{
            $aResult=['status'=>2];
        }
        return json_encode($aResult);

    }
    function get_assigned_order_count($iStatus,$dDate){
        
        /*AND rider_id is NUll*/
        $aResult = DB::select('
            SELECT 
                o.id,
                o.order_number,
                o.order_total_price,
                o.order_status,
                C.customer_name,
                COUNT(oi.id) as "TotalItems",
                u.name
            FROM orders AS o 
            INNER JOIN order_items AS oi ON oi.order_id =o.id
            INNER JOIN users AS u ON u.id =o.rider_id
            INNER JOIN customers AS C ON C.id =o.customer_id 
            WHERE order_status = "'.$iStatus.'" 
            AND DATE_FORMAT(order_date, "%Y-%m-%d") = "'.$dDate.'"
            GROUP BY o.id
        ');

        return $aResult;
    }
    function get_new_order_count($dDate){
        
        $aResult =  DB::select('
            SELECT 
                o.id,
                o.order_number,
                o.order_total_price,
                o.order_status,
                C.customer_name,
                COUNT(oi.id) as "TotalItems"
            FROM orders AS o 
            INNER JOIN order_items AS oi ON oi.order_id =o.id
            INNER JOIN customers AS C ON C.id =o.customer_id 
            WHERE order_status = 0 
            AND rider_id is NUll 
            AND DATE_FORMAT(order_date, "%Y-%m-%d") = "'.$dDate.'"
            GROUP BY o.id
            ORDER BY o.id DESC
        ');

        return $aResult;
    }
    function get_items_count($dDate){
        
        $aResult =  DB::select('
            SELECT 
                I.productName , 
                I.productQuantity,
                (
		            SELECT 		
                        COALESCE(SUM(OI.productQuantity),0) AS "Remaining" 
                    FROM 
                    order_items AS OI 
                    INNER JOIN orders AS O ON O.id = OI.order_id
                    WHERE 1=1
                    AND DATE_FORMAT(O.order_date, "%Y-%m-%d") = "'.$dDate.'"
                    AND OI.productId = I.productId
                ) AS "Ordered",
                ( 
                    I.productQuantity - (
		            SELECT 		
                    COALESCE(SUM(OI.productQuantity),0) AS "Remaining" 
                    FROM 
                    order_items AS OI 
                    INNER JOIN orders AS O ON O.id = OI.order_id
                    WHERE 1=1
                    AND DATE_FORMAT(O.order_date, "%Y-%m-%d") = "'.$dDate.'"
                    AND OI.productId = I.productId
                )) AS "Remaining"
            
            FROM 
            items AS I
            
            WHERE 1=1
            GROUP BY I.productId,I.productName
        ');
        return $aResult;
    }

    function index11(){
        
        // flush();
        
        // header('Content-Type: text/event-stream');
        // header('Cache-Control: no-cache');
        
        // $time = date('r');
        // echo "data: The server time is: {$time}\n\n";
        // flush();
        
        $response = new StreamedResponse(function() {
            while(true) {
                
                $sTotalOrdersCount    = Order::count();
                $sNewOrderCount       = Order::where('order_status', '=', 0);
                $sPendingOrderCount   = Order::where('order_status', '=', 1);
                $sProcessedOrderCount = Order::where('order_status', '=', 2);
        
        
                $aData['TotalOrders']     = $sTotalOrdersCount;
                $aData['NewOrdersCount']  = $sNewOrderCount->count();
                $aData['PendingOrdersCount']   = $sPendingOrderCount->count();
                $aData['ProcessedOrdersCount'] = $sProcessedOrderCount->count();
        
                $dToday = date('Y-m-d');
                $aData['Orders'] = $this->get_new_order_count($dToday) ;
                $aData['ItemsDetail'] = $this->get_items_count($dToday);
                
                $aResponse = json_encode($aData);
                
                echo "data:{$aResponse}\n\n";
                //echo 'data: ' . json_encode($aResponse) . "\n\n";
                ob_flush();
                flush();
                sleep(3);
            }
        });

        $response->headers->set('Content-Type', 'text/event-stream');
        $response->headers->set('X-Accel-Buffering', 'no');
        $response->headers->set('Cach-Control', 'no-cache');
        return $response;

        
    }
}
