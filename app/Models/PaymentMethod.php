<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $table = 'payment_method';

    protected $fillable = [
        'method',
        'created_at',
        'updated_at',
    ];

    // Quan hệ với bảng orders
    public function orders()
    {
        return $this->hasMany(Order::class, 'payment_method_id');
    }
}
