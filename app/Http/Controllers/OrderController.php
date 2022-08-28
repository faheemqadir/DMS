<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Order;
use DB;

class OrderController extends Controller
{
    // get all orders
    function get_order($id = 0){
        //DB::enableQueryLog();
        $aData['orders'] = DB::table('orders')
        ->select('orders.id',
                 'shops.shop_name',
                 'customers.customer_name',
                 'users.name',
                 'orders.order_approved_by',
                 'orders.order_status',
                 'orders.order_date',
                 'orders.order_total_price',
                 'order_items.productId')
        ->join('order_items','orders.id','=','order_items.id')
        ->join('shops','orders.shop_id','=','shops.id')
        ->join('customers','orders.customer_id','=','customers.id')
        ->join('users','orders.rider_id','=','users.id')
        ->orderBy('orders.id', 'DESC')
        ->get()->toArray();

       
        //dd(DB::getQueryLog());
        // $aData['orders'] = Order::join('order_items', 'orders.id', '=', 'order_items.order_id')
        //        ->get(['orders.*', 'order_items.*']);

        // echo"<pre>";
        // print_r($aData);
        // die;
        return view("order.index",$aData);
    }
    function order_detail_items($id){
        
        $iOrderId =  $id;
        DB::enableQueryLog();
        $aData['Order'] = DB::select('
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
            WHERE O.id = "'.$iOrderId .'"
        ')[0];

        $aData['OrderDetail'] = DB::select('
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
        OI.order_id = "'.$iOrderId .'"
        ');
        
        $aResult = [];
        if(count($aData) > 0){
            $aResult=['status'=>1,"data"=>$aData];
        }else{
            $aResult=['status'=>2];
        }
        // return json_encode($aResult);
        return view("order.order_detail",$aData);

    }
}
