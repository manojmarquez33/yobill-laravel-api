<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable (fillable).
     */
    protected $fillable = [
        'product_name',
        'product_id',
        'product_image',
        'product_description',
        'product_price',
        'product_stock',
    ];

    /**
     * The attributes that should be appended to model's array and JSON output.
     */
    protected $appends = ['product_image_url'];

    /**
     * Accessor to get full URL of the product image.
     */
    public function getProductImageUrlAttribute()
    {
        return asset('uploads/products/' . $this->product_image);
    }
}
