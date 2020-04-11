<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
	protected $table = 'tags';
	protected $fillable = ['name', 'slug', 'status'];
    public function users() {
        return $this->belongsTo('App\User', 'created_by');
    }
    public function articles() {
        return $this->belongsToMany('App\Articles');
    }
}
