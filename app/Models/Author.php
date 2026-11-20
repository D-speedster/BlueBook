<?php

namespace App\Models;

use App\Helpers\SlugHelper;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'biography',
        'photo',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($author) {
            if (empty($author->slug)) {
                $author->slug = SlugHelper::makeUnique(
                    $author->name,
                    self::class
                );
            }
        });
        
        static::updating(function ($author) {
            if ($author->isDirty('name') && !$author->isDirty('slug')) {
                $author->slug = SlugHelper::makeUnique(
                    $author->name,
                    self::class,
                    'slug',
                    $author->id
                );
            }
        });
    }
}
