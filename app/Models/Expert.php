<?php

namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

 class Expert extends Authenticatable
{
    use softDeletes;
    use HasApiTokens, HasFactory, Notifiable;
   // public $timestamps=false;
    protected $fillable = [
         'phon', 
       'address', 'detials', 'photo',
       'name',
       'email',
       'password','cost',
      
      
       

    ];
    protected $hidden = [
      'password',
      'remember_token',
  ];
  protected $casts = [
   'email_verified_at' => 'datetime',
];
 
public function speciality(){
    return $this->belongsToMany('App\Models\Speciality');
 }
 public function user(){
  return $this->belongsTo('App\Models\User');
}
public function time(){
  return $this->belongsToMany('App\Models\time');
}

}
