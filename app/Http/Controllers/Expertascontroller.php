<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Time;
use App\Models\Expert;
use App\Models\Link;
use App\Models\Day;
use App\Models\User;
use App\Models\Speciality;
use Laravel\Passport\RefreshToken;
use Laravel\Passport\Token;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

class Expertascontroller extends Controller
{  
public function index($b){
   $specilatiy=Speciality::find($b)->expert;
   return response()->json(['message'=>$specilatiy],200);
 }
 
public function registerexpert (Request $request){
    //validate
    $request->validate([
       
        'name'=>'required',
        'email' => 'required|email|unique:experts',
        'password'=>'required',
        'phon'=>'required|unique:experts',
        'address' => 'required',
        'detials'=>'required',
        'cost'=>'required',
        'photo'=>'required|image', 
        'speciality'=>'required|array',
       
 ]);
    $expert=new Expert();
    $expert->name=$request->name;
    $expert->email=$request->email;
    $expert->password=bcrypt($request->password);
    $expert->phon=$request->phon;
    $expert->address=$request->address;
    $expert->detials=$request->detials;
    $expert->cost=$request->cost;
    $expert->photo=$request->file('photo')->store('\public\storage\myimag');
    $expert->save();
    $expert->speciality()->attach($request->speciality);
    
 
    return response()->json(['message'=>'Expert create successfully' ],200);
   
 } 
 public function loginexpert(Request $request){
  $validator = Validator::make($request->all(), [
    'email' => 'required|email',
    'password' => 'required',
   ]);

    if($validator->fails()){
    return response()->json(['error' => $validator->errors()->all()]);
    }

    if(auth()->guard('expert')->attempt(['email' => request('email'), 'password' => request('password')])){

    config(['auth.guards.api.provider' => 'expert']);
    
    $expert = Expert::select('experts.*')->find(auth()->guard('expert')->user()->id);
   
    $token = $expert ->createToken('WERTYUIOP',['expert'])->accessToken; 

    return response()->json( ['access_token' =>$token ] , 200);
    }else{ 
    return response()->json(['error' => ['Email and Password are Wrong.']], 200);
   }
}
 

public function storeSpeciality(Request $request){
  $request->validate([
       'name'=>'required|unique:specialities',
  ]);
  $specilatiy=new speciality();
  $specilatiy->name=$request->name;
  $specilatiy->save();
  return response()->json(['message'=>'speciality create successfully'],200);
}
public function storeDays(Request $request){
  $request->validate([
       'name_day'=>'required|unique:days',
  ]);
  $day=new day();
  $day->name_day=$request->name_day;
  $day->save();
  return response()->json(['message'=>'Day create successfully'],200);
}


public function search(Request $request , $value){
    
     $expert =Expert::query()
     ->where('name', 'LIKE', "%".$value."%")
     
     ->get();
     return response()->json(['message'=> $expert], 200);

    }
    
  
       
public function show(Request $request, $value){
  return Expert::query()->where('id', 'LIKE', "$value")->get();
      }
public function delete(Expert $expert){
        $expert->deleted();
        return response()->json('deleted successfully', 200);
}    
  
public function logoutexpert()
{      
      Auth::guard('expert-api')->user()->token()->revoke();
       return response()->json([
      'message'  => 'Expert Logout successfully',], 200);
} 



}
 
