<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Miss extends Model
{
    protected $table = 'miss';

    public $timestamps = false;

    protected $fillable = ['*'];
  
}
