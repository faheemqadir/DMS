<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    //

    function index(){
        $aData['settings'] = Setting::all()->toArray();
        return view("setting.index",$aData);
    }
    function save_setting(Request $request){

        
        
        Setting::where('setting_name','credit_limit')->update([ 'setting_value'=> $request->get('credit_limit')]);
        Setting::where('setting_name','rider_collection_limit')->update([ 'setting_value'=> $request->get('rider_collection_limit')]);
        Setting::where('setting_name','order_start_time')->update([ 'setting_value'=> $request->get('order_start_time')]);
        Setting::where('setting_name','order_end_time')->update([ 'setting_value'=> $request->get('order_end_time')]);

        return redirect('setting')->with('success', 'Data has been added');
    }
}
