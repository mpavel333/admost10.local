<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Carbon\Carbon;
use App\Models\UserPackage;
use DB;
//use App\User;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
       // 'admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
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
        'password' => 'hashed',
    ];
    
    public function isAdmin()
    {
        if((int)$this->role==1){
            return true;
        }else{
            return false;
        }
    } 

    public function isUser()
    {
        if((int)$this->role==0){
            return true;
        }else{
            return false;
        }
    } 

    public function getRedirectRoute()
    {
        return match((int)$this->role){
            0 => '/user',
            1 => '/admin',
        };
    }
    
    public function getUserPackage() {
        return $this->hasOne('App\Models\UserPackage', 'user_id')->where('date_end', '>' ,Carbon::now())->orderBy('id', 'desc');
    }
    
    public function PackageInfo() {
        if($this->getUserPackage) return json_decode($this->getUserPackage->package);
    }
     
}










