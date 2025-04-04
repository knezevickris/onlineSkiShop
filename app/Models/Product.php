<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //protected $table = 'products';
//    protected $fillable = [
//        'name', 'sale_price','regular_price', 'description', 'category_id', 'has_sizes', 'gender', 'brand_id'
//    ];

    //protected $guarded = ['id'];

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function brand(){
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    public function favoritedByUsers()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }

}
