<?php

namespace App\Models;

use App\Helpers\SlugHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Publisher extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'website',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($publisher) {
            if (empty($publisher->slug)) {
                $publisher->slug = SlugHelper::makeUnique(
                    $publisher->name,
                    self::class
                );
            }
        });
        
        static::updating(function ($publisher) {
            if ($publisher->isDirty('name') && !$publisher->isDirty('slug')) {
                $publisher->slug = SlugHelper::makeUnique(
                    $publisher->name,
                    self::class,
                    'slug',
                    $publisher->id
                );
            }
        });
    }

    public function productVariants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }
}
