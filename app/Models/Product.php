<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;

    protected $table = 'product';


    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'price',
        'description',
        'quantity',
        'status',
    ];


    public $timestamps = true;
    protected $dates = ['deleted_at'];



    public function images()
    {
        return $this->hasMany(ImageProduct::class);
    }



    public function details()
    {
        return $this->hasMany(ProductDetail::class);
    }

    // Quan hệ với bảng danh mục (belongsTo)
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function favoriteProducts()
    {
        return $this->hasMany(FavoriteProduct::class, 'product_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Quan hệ 1-n: Sản phẩm có thể nằm trong nhiều mục giỏ hàng
    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'product_id');
    }

    public static function getTopProducts()
    {
        return self::select('order_item.name', 'product.price', 'product.quantity', 'product.description', DB::raw('SUM(order_item.quantity) AS total_quantity'), 'image_product.link AS image_link')
    ->join('order_item', 'order_item.product_id', '=', 'product.id')
    ->join('order', 'order.id', '=', 'order_item.order_id')
    ->joinSub(
        DB::table('image_product')
            ->select('product_id', DB::raw('MIN(id) AS min_image_id'))
            ->groupBy('product_id'),
        'img_min',
        'img_min.product_id',
        '=',
        'product.id'
    )
    ->join('image_product', 'image_product.id', '=', 'img_min.min_image_id')
    ->where('order.status_payment', 2)
    ->groupBy('product.id','order_item.name', 'product.price', 'product.quantity', 'product.description','image_link')
    ->orderByDesc('total_quantity')
    ->limit(5)
    ->get();
    }
}
