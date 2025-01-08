<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';
    public $timestamps = false;

    // Các cột có thể được gán giá trị hàng loạt
    protected $fillable = [
        'ordercustomer_id', // Thêm cột ordercustomer_id
        'payment_method_id',
        'status',
        'status_payment',
        'shipping_fee',
        'total',
        'delivery_at',
        'completed_at',
        'canceled_at',
        'created_at',
    ];

    // Định nghĩa quan hệ với model OrderCustomer
    public function orderCustomer()
    {
        return $this->belongsTo(OrderCustomer::class, 'ordercustomer_id');
    }

    // Định nghĩa quan hệ với model PaymentMethod
    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id');
    }

    // Quan hệ với bảng order_items
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
