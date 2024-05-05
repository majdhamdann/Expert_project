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
use Calendar;

class Bookcontroller extends Controller
{

public function changeLanguage(Request $request)
    {
        $validated = $request->validate([
            'language' => 'required',
        ]);

        \Session::put('language', $request->language);

        return response()->json(['message'=>$request->language ],200);
    }
public function createBook(Request $request){
        $data=$request->validate([
              'start'=>'required',
              'end'=>'required',
              'title'=>'required',
         ]);
         $book=new Time();
         $book->start=$request->start;
         $book->end=$request->end;
         $book->title=$request->title;
         $book->expert_id=auth()->user()->id;
         $book->save();
         return response()->json(['message'=>$book ],200);
         
         }
    


public function index()
    {
       if(request()->ajax()) 
        {
 
         $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
         $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');
 
         $data = Time::whereDate('start', '>=', $start)->whereDate('end',   '<=', $end)->get(['id','title','start', 'end']);
         return response()->json(['message'=>$data ],200);
        }
        
    	

      
    }

    public function update(Request $request)
    {   
        $where = array('id' => $request->id);
        $updateArr = ['title' => $request->title,'start' => $request->start, 'end' => $request->end];
        $event  = Time::where($where)->update($updateArr);
 
        return response()->json(['message'=> $event ],200);
    } 
 
 
    public function destroy(Request $request)
    {
        $event = Time::where('id',$request->id)->delete();
   
        return response()->json(['message'=> $event ],200);
    }    
    
     
}