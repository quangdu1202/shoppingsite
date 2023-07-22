<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class,'brand_id','id');
    }

    public function productCategory(): BelongsTo
    {
        return $this->belongsTo(productCategory::class,'product_category_id','id');
    }

    public function productImages(): HasMany
    {
        return $this->hasMany(productImage::class,'product_id','id');
    }

    public function productDetails(): HasMany
    {
        return $this->hasMany(productDetail::class,'product_id','id');
    }

    public function productComments(): HasMany
    {
        return $this->hasMany(productComment::class,'product_id','id');
    }

    public function orderDetails(): HasMany
    {
        return $this->hasMany(orderDetail::class,'product_id','id');
    }
}
