<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategories extends Model
{
    protected $table = 'sub_categories';
    protected $fillable = [
        'name','slug','order','status','categories_id',
    ];
    public function categories() {
        return $this->belongsTo('App\Categories', 'categories_id');
    }
    public function articles() {
        return $this->hasMany('App\Articles', 'sub_categories_id');
    }
}
