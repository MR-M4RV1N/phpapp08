<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatSubSub extends Model
{
    protected $table = "cat_sub_sub";

    protected $fillable = ['title', 'description', 'cat_sub'];

    public $timestamps = false;
}
