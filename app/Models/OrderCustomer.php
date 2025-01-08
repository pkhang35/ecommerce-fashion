<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderCustomer extends Model
{
    use HasFactory;

    protected $table = 'order_customer';
    public $timestamps = false;

    // Các cột có thể được gán giá trị hàng loạt
    protected $fillable = [
        'account_id', // Thêm account_id
        'lastname',
        'firstname',
        'address',
        'phone',
        'created_at',
        'updated_at',
    ];

    // Định nghĩa quan hệ với model Account
    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }

    // Định nghĩa quan hệ với model Order
    public function orders()
    {
        return $this->hasMany(Order::class, 'ordercustomer_id');
    }
}
