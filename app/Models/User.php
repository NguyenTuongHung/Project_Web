<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name','email','password'];

    protected $hidden = ['password','remember_token'];

    public function orders()
{
    // Một user có nhiều đơn hàng
    return $this->hasMany(Order::class);
}
         
public function reviews() {
    return $this->hasMany(\App\Models\Review::class);
}

}

