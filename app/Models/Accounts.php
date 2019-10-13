<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Accounts extends Model
{
    protected $table = "accounts";

    protected $fillable = ['username', 'password', 'email'];

    public $timestamps = false;
}
