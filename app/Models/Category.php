<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;



    protected $table = 'category';


    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'image',
        'status',
    ];
    public function getStatusAttribute($value)
    {
        return $value == 1 ? 'Hiện' : 'Ẩn';
    }
    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = (int) $value;
    }
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // public function parent()
    // {
    //     return $this->belongsTo(Category::class, 'parent_id'); // Một danh mục có thể có một danh mục cha
    // }


    // public function children()
    // {
    //     return $this->hasMany(Category::class, 'parent_id'); // Một danh mục có thể có nhiều danh mục con
    // }


    // public function products()
    // {
    //     return $this->hasMany(Product::class); // Một danh mục có thể có nhiều sản phẩm
    // }
}

    // protected $table = 'category'; 
    // protected $fillable = [
    //    'id','parent_id','name','slug','image','status','created_at','update_at'
    // ];

   


