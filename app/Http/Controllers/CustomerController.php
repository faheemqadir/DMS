<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    //

    function get_customer(){
        $aData['customers'] = Customer::all()->toArray();
        return view("customer.index",$aData);
    }

    function get_customer_by_id($id=null){


        $aData = Customer::where('id',$id)->get();

        if( count($aData) > 0 ){
            $response=['status'=>1,"msg"=>"data found","data"=> $aData->toArray()];
        }else{
            $response=['status'=>2,"msg"=>"data not found"];
        }

        return json_encode($response);
    }

    function add_customer(Request $request){

        $Customer = new Customer();
        $Customer->customer_name = $request->get('customer_name');
        $Customer->customer_email = $request->get('customer_email');
        $Customer->customer_contact = $request->get('customer_contact');
        $Customer->customer_address = $request->get('customer_address');
        //$Customer->updated_at = date("Y-m-d H:i:s");
        //$Customer->created_at = date("Y-m-d H:i:s");
        
        $Customer->save();
        return redirect('customer')->with('success', 'Data has been added');
    }
    function edit_customer(Request $request){

        $customer_id = $request->get('customer_id');
        if($customer_id){
            $Customer = Customer::find($customer_id);
            $Customer->customer_name = $request->get('customer_name');
            $Customer->customer_email = $request->get('customer_email');
            $Customer->customer_contact = $request->get('customer_contact');
            $Customer->customer_address = $request->get('customer_address');
            $Customer->save();
        }
        return redirect('customer')->with('success', 'Data has been added');

    }
    function wallet(){
        $aData['customers'] = Customer::all()->toArray();
        return view("customer.wallet",$aData);
    }
    function update_customer_wallet(Request $request){

        $iCustomer_id = $request->get('customer');
        
        $dAmount = $request->get('transcation_amount');
        $iamounttype = $request->get('transcation_type');
        $stranscation_number = $request->get('transcation_number');

        $Customer = Customer::find($iCustomer_id)->toArray();

        if( !empty($Customer) ){
            $dWallet = $Customer['customer_wallet'];

            $CustomerUp = Customer::find($iCustomer_id);
            $dWallet = ($dWallet+$dAmount);
            $CustomerUp->customer_wallet = $dWallet;
            $CustomerUp->save();
            
        }
        return redirect('customer')->with('success', 'Data has been added');
        
    }
}
