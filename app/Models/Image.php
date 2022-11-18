<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
        'bog_post_id',
    ];

    public function blogPost(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(BlogPost::class);
    }
}
