<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'name','slug','dir','order','status','created_by',
    ];
    public function users() {
        return $this->belongsTo('App\User', 'created_by');
    }
    public function articles() {
        return $this->hasMany('App\Articles', 'categories_id');
    }
    public function subcategories() {
        return $this->hasMany('App\SubCategories', 'categories_id');
    }
}
