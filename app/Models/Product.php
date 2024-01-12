<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable =
    [
        'cate_id',
        'name',
        'slug',
        'small_description',
        'description',
        'original_price',
        'selling_price',
        'image',
        'albums',
        'qty',
        'tax',
        'shipp_cost',
        'shipp_cost_out',
        'status',
        'trending',
        'meta_title',
        'meta_keywords',
        'meta_description'
    ];

    public function category(){
        return $this->belongsTo(Category::class , 'cate_id' , 'id');
    }
    // public function productColors() {
    //     return $this->hasMany(ProductColorSize::class, 'product_id', 'id');
    // }
    public function productColorSizes() {
        return $this->hasMany(ProductColorSize::class, 'product_id', 'id');
    }
}
