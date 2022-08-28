<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UserController extends Controller
{
    //
    
    function get_user($id = 0){
        
        $aData['users'] = User::where("user_type",3)->get()->toArray();
        $aData['roles'] =  Role::pluck('name','name')->all();
        
       
        return view("user.index",$aData);
    }
    function add_user(Request $request){
        
        $user = new user();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->user_type = 3;
        $user->password = bcrypt($request->get('password')) ;
        //$Customer->updated_at = date("Y-m-d H:i:s");
        //$Customer->created_at = date("Y-m-d H:i:s");
        
        $user->save();
        $user->assignRole($request->input('roles'));

        return redirect('user')->with('success', 'Data has been added');
    }
    function get_user_by_id($id=null){
        $aData = user::where('id',$id)->get();
        if( count($aData) > 0 ){
            $response=['status'=>1,"msg"=>"data found","data"=> $aData->toArray()];
        }else{
            $response=['status'=>2,"msg"=>"data not found"];
        }
        return json_encode($response);
    }
    function edit_user(Request $request){
        
        $user_id = $request->get('user_id');
        
        if($user_id){
            
            DB::table('model_has_roles')->where('model_id',$user_id)->delete();
            $user->assignRole($request->input('roles'));
          
            //$request->input('roles')
            $user = user::find($user_id);
            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->password = $request->get('password');
           
            $user->save();
            
        }
        return redirect('user')->with('success', 'Data has been added');



    }
    function get_rider($id = 0){
        $aData['users'] = User::where("user_type",4)->get()->toArray();
        return view("rider.index",$aData);
    }
    function add_rider(Request $request){

        $user = new user();
        $user->name = $request->get('name');
        //$user->email = $request->get('email');
        $user->user_type = 4;
        $user->contact = $request->get('contact');
        $user->password = $request->get('password');
        
        //$Customer->updated_at = date("Y-m-d H:i:s");
        //$Customer->created_at = date("Y-m-d H:i:s");
        
        $user->save();
        return redirect('rider')->with('success', 'Data has been added');
    }
    function get_rider_by_id($id=null){
      
        $aData = user::where('id',$id)->get();
        if( count($aData) > 0 ){
            $response=['status'=>1,"msg"=>"data found","data"=> $aData->toArray()];
        }else{
            $response=['status'=>2,"msg"=>"data not found"];
        }
        return json_encode($response);
    }
    function edit_rider(Request $request){

        $user_id = $request->get('id');
        
        if($user_id){
            
            $user = user::find($user_id);
            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->password = $request->get('password');
            $user->status = $request->get('status');
           
            $user->save();
        }
        return redirect('rider')->with('success', 'Data has been added');
    }
    function verify_number($number){

        $response =[];
        $sNumber = User::where("contact",$number)->count();
        if($sNumber)
        $response=['status'=>2,"msg"=>"Contact number already exist"];
        else
        $response=['status'=>1];
        
        return json_encode($response);
    }
    
    
    
}

