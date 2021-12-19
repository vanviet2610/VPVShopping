<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'id', 'title', 'price', 'content', 'status', 'file_name',  'file_path', 'user_id', 'category_id'
    ];

    public function images()
    {
        return $this->hasMany(Product_image::class, 'product_id');
    }
    public function tags()
    {
        return $this->belongsToMany(Tags::class, 'product_tag', 'product_id', 'tag_id')->withTimestamps();
    }

    public function user_product()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
