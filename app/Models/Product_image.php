<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_image extends Model
{
    use HasFactory;
    protected $fillable = ['file_name', 'file_path', 'product_id'];

    public function infor_ProductImage()
    {
        return $this->belongsTo(Product::class, 'id');
    }
}
