<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'description',
        'image',
        'stock'
    ];
    public function transactions()
    {
        return $this->belongsTo(Order::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
