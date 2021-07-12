<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name', 'description', 'unique_code', 'category_id'
    ];

    public function category () {
        return $this->belongsTo(ProductCategory::class);
    }
}
