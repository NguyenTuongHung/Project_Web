<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['items','total','status','user_id'];

    protected $casts = [
        'items' => 'array'
    ];

    // nếu cần liên kết user
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}




