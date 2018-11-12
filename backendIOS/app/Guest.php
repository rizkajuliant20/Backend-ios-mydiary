<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $table = "guests";

    protected $fillable = ['name','email','username','no_hp','password','check'];
}
