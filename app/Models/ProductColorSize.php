<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductColorSize extends Model
{
    use HasFactory;

    protected $table = 'product_attr';

    protected $fillable =
    [
        'product_id',
        'color_id',
        'size_id',
        'qty',
        'color_image'
    ];

    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id', 'id');
    }
    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id', 'id');
    }
}
