<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
    ];

    public function imageable(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->morphTo();
    }

    public function url()
    {
        return Storage::url($this->path);
    }
}
