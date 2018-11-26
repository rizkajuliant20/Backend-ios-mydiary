<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
//use Illuminate\Foundation\Auth\User as Authenticatable;

class Guest extends Authenticatable
{
    use Notifiable;

    protected $table = "guests";

    protected $fillable = ['name','email','username','no_hp','password'];

    protected $hidden = ['password', 'email_token', 'remember_token'];
}
