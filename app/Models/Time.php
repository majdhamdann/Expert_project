<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class time extends Model
{
    use HasFactory;
    //public $timestamps=false;
    protected $fillable = [
        'start','end','title','expert_id',
   ];

   public function expert(){
    return $this->belongsTo('App\Models\Expert');
 }
 
 public function user(){
    return $this->belongsTo('App\Models\User','user_id');
 }
 
}
