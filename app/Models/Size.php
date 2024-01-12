<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $table = 'sizes';
    protected $fillable = ['value', 'status'];

    public function productsColorsSizes() {
        return $this->hasMany(ProductColorSize::class, 'size_id', 'id');
    }


}
