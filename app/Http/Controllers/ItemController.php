<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    //
    function get_item($id = 0){
     
    
        $aData['items'] = Item::all()->toArray();
        return view("item.index",$aData);
    }
    function add_item(Request $request){

        $Item = new Item();
        $Item->productName = $request->get('productName');
        $Item->productDescription = $request->get('productDescription');
        $Item->productScale = $request->get('productScale');
      //$Customer->updated_at = date("Y-m-d H:i:s");
        //$Customer->created_at = date("Y-m-d H:i:s");
        
        $Item->save();
        return redirect('item')->with('success', 'Data has been added');
    }
    function get_item_by_id($id=null){

        $aData = Item::where('productId',$id)->get();
        if( count($aData) > 0 ){
            $response=['status'=>1,"msg"=>"data found","data"=> $aData->toArray()];
        }else{
            $response=['status'=>2,"msg"=>"data not found"];
        }
        return json_encode($response);
    }
    function edit_item(Request $request){

        $item_id = $request->get('productId');

        if($item_id){
            
            $Item = Item::find($item_id);
            $Item->productName = $request->get('productName');
            $Item->productDescription = $request->get('productDescription');
            $Item->productScale = $request->get('productScale');
           
            $Item->save();
        }
        return redirect('item')->with('success', 'Data has been added');



    }
    
    function update_all_item(Request $request){

        $aItems = $request->get('productId');
        //$aItemPurchasePrice = $request->get('item_purchase_price');
        $aItemSalePrice = $request->get('productRetailRaterice');
        $aItemQuantity = $request->get('productQuantity');


        $aItemsInsert = [];
        foreach($aItems as $i=>$iItemId){
            
            $iItemPurchasePrice = 0;
            $iItemSalePrice = 0;
            $iItemQty = 0;

            if(  $aItemSalePrice[$i] > 0){
                //$iItemPurchasePrice = $aItemPurchasePrice[$i];  
                $iItemSalePrice = $aItemSalePrice[$i];
                $iItemQty = $aItemQuantity[$i];
              
            }
            
            $Item = Item::find($iItemId);
            //$Item->item_purchase_price =  $iItemPurchasePrice;
            $Item->productRetailRaterice =  $iItemSalePrice;
            $Item->productQuantity =  $iItemQty;
            $Item->productUpdatedOn =  date('Y-m-d H:i:s');
            $Item->productUpdatedBy =  auth()->user()->id;

            $Item->save();
        }
        
        return redirect('item')->with('success', 'Data has been added');


    }
}
