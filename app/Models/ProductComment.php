<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin Builder
 */
class ProductComment extends Model
{
    use HasFactory;
    protected $table = 'product_comments';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
