<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\RefreshToken;
use Laravel\Passport\Token;
use Validator;
    
class usercontroller extends Controller
{
   
    
    public function registeruser (Request $request){
        //validate
       
        $request->validate([
           
            'name'=>'required',
            'email' => 'required|email|unique:users',
            'password'=>'required',
          
        ]);
        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=bcrypt($request->password);
        $user->save();
        return response()->json(['message'=>'User create successfully'],200);
     } 
    public function loginuser(Request $request){
         
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
           ]);
        
            if($validator->fails()){
            return response()->json(['error' => $validator->errors()->all()]);
            }
        
            if(auth()->guard('user')->attempt(['email' => request('email'), 'password' => request('password')])){
        
            config(['auth.guards.api.provider' => 'user']);
            
            $user = User::query()->select('users.*')->find(auth()->guard('user')->user()->id);
           
            $token = $user ->createToken('WERTYUIOP',['user'])->accessToken; 
        
            return response()->json( ['access_token' =>$token ] , 200);
            }else{ 
            return response()->json(['error' => ['Email and Password are Wrong.']], 200);
           }
     }
    public function logoutuser(Request $request)
     {    Auth::guard('user-api')->user()->token()->revoke();
           
            return response()->json([
                'message'  => 'User Logout successfully',], 200);
     }     
    
    
   


    }





