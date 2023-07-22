<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin Builder
 */
class ProductCategory extends Model
{
    use HasFactory;
    protected $table = 'product_categories';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class,'product_category_id','id');
    }
}
