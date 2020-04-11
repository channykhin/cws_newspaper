<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
	protected $table = 'articles';
    protected $fillable = [
         'title',
         'slug',
         'body',
         'editor',
         'source',
         'img',
         'body',
         'short_desc',
         'link',
     ];
    public function users() {
        return $this->belongsTo('App\User', 'user_id');
    }
    public function categories() {
        return $this->belongsTo('App\Categories', 'categories_id');
    }
    public function subcategories() {
        return $this->belongsTo('App\SubCategories', 'sub_categories_id');
    }
    public function tags() {
        return $this->belongsToMany('App\Tags');
    }
}
