<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\User;
use App\Models\Order;
use App\Models\Customer;
use DB;

class ReportController extends Controller
{
    //


     function index(){

        return view('report.reports'); 
     }
     function saleReport($s,$e){

        $dStartDate = $s;
        $dEndDate   = $e;

        $aReturnData = [];

        $aData = DB::select('
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
            WHERE 1=1 
            AND DATE(order_date) BETWEEN "'.$dStartDate.'" AND "'.$dEndDate.'"
            GROUP BY o.id
        ');
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
        $aData['PendingOrders'] =  $aReturnData;
        
        return view('report.view_report',$aData);  
     }
     function itemReport($s,$e){

        $dStartDate = $s;
        $dEndDate   = $e;

        $aReturnData = [];

        $aData = DB::select('
            SELECT 
                I.productName,
                SUM(OI.productPrice) AS "TotalSale",
                SUM(OI.productQuantity) AS "Quantity",
                O.order_date
            FROM items AS I
            INNER JOIN order_items AS OI ON OI.productId = I.productId
            INNER JOIN orders AS O ON O.id=OI.order_id
            GROUP BY I.productId
        ');
        $aData['ItemReport'] =  $aData;
        
        return view('report.item_report',$aData);  
     }
     function generate_order_tags(){
        
        $aData = DB::select('
        SELECT 
            C.customer_name,
            C.customer_address,
            C.customer_contact,
            O.order_number,
            O.order_total_price,
            COUNT(OI.id) AS "order_item"
        FROM
        orders AS O 
        INNER JOIN customers AS C ON C.id = O.customer_id
        INNER JOIN order_items AS OI ON OI.order_id=O.id
        GROUP BY O.id,C.id
        ');
        // echo "<pre>";
        // print_r($aData);
        // die;
        $fileName = 'tasks.csv';
        

         $headers =  array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Customer Name', 'Address', 'Contact', 'Order Number','Order Items' ,'Total Price');

        $callback = function() use($aData, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($aData as $task) {
                $row['Customer Name'] = $task->customer_name;
                $row['Address']       = $task->customer_address;
                $row['Contact']       = $task->customer_contact;
                $row['Order Number']  = $task->order_number;
                $row['Order Item']    = $task->order_item;
                $row['Total Price']   = $task->order_total_price;

                fputcsv($file, array($row['Customer Name'], $row['Address'], $row['Contact'], $row['Order Number'],$row['Order Item'],$row['Total Price']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
     }
}
