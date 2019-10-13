<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatSub extends Model
{
    protected $table = "cat_sub";

    protected $fillable = ['title', 'description', 'cat'];

    public $timestamps = false;
}
