<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Cmgmyr\Messenger\Traits\Messagable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use Messagable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public $timestamps=false;
    protected $fillable = [
        'name',
        'email',
        'password',
       
        

    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function expert(){
        return $this->belongsToMany('App\Models\expert');
     }
     public function speciality(){
        return $this->belongsToMany('App\Models\speciality','speciality_id');
     }
     public function time(){
        return $this->hasOne('App\Models\time');
     }
}
