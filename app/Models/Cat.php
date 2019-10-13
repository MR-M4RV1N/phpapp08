<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
    protected $table = "cat";

    protected $fillable = ['title', 'description'];

    public $timestamps = false;
}
