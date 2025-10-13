<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'desc',
        'img',
        'price',
        'sale_price',
        'is_sale',
    ];

    protected $casts = [
        'is_sale' => 'boolean',
    ];

    // Helper: Giá hiển thị (ưu tiên giá khuyến mãi nếu có)
    public function getDisplayPriceAttribute()
    {
        return $this->is_sale && $this->sale_price ? $this->sale_price : $this->price;
    }
}







