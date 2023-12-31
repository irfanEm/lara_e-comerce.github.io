<?php

namespace App\Models;

use App\Models\User;
use App\Models\Transactions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_paid',
        'payment_receipt',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->belongsTo(Transactions::class);
    }
}
