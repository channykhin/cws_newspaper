<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
	protected $table = 'ads';
    protected $fillable = ['name','url','img','page','position','price','size','status',
     ];
}
