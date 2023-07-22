<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin Builder
 */
class BlogComment extends Model
{
    use HasFactory;
    protected $table = 'blog_comments';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function blog(): BelongsTo
    {
        return $this->belongsTo(Blog::class,'blog_id','id');
    }
}
