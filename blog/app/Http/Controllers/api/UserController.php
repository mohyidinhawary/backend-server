<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Post
    public function Register(Request $request){
//validation
$request->validate([
    "name"=>"required",
    "email"=>"required|email|unique:users",
    "phone_no"=>"required",
    "password"=>"required|confirmed"
]);
// create user+save
$user=new User();
$user->name=$request->name;
$user->email=$request->email;
$user->phone_no=$request->phone_no;
$user->password=bcrypt($request->password);
$user->save();
// send response
return response()->json([
'status'=>1,
'massege'=>'user registered succsessfully'

],200);
    }
    //Post
    public function Login(Request $request){
        //validation
        $request->validate([
            "email"=>"required|email",
            "password"=>"required",
            //verify user + token
            
        ]);
         //verify user + token
        if(!$token=auth()->attempt(["email"=>$request->email,"password"=>$request->password])){
            return response()->json([
                'status'=>0,
                'message'=>'invaild'
            ]);
        }
            // response
            return response()->json([
                'status'=>1,
                'message'=>'logged in successfully',
                'token'=>$token
            ]);
        }
    
    //get
    public function Profile(){
        $user_data=auth()->user();
        return response()->json([
            'status'=>1,
            'message'=>'user profile data',
            'use data'=>$user_data
        ]);
        
    }
    //get
    public function Logout(){
        auth()->Logout();
        return response()->json([
            'status'=>1,
            'message'=>'user logged out '
        ]);
        
    }
}
