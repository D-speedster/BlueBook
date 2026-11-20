<?php

namespace App\Models;

use App\Helpers\SlugHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'description',
        'summary',
        'authors',
        'image',
        'cover_image',
        'product_type',
        'price',
        'stock',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'price' => 'integer',
        'stock' => 'integer',
        'authors' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = SlugHelper::makeUnique(
                    $product->title,
                    self::class
                );
            }
        });
        
        static::updating(function ($product) {
            if ($product->isDirty('title') && !$product->isDirty('slug')) {
                $product->slug = SlugHelper::makeUnique(
                    $product->title,
                    self::class,
                    'slug',
                    $product->id
                );
            }
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function publishedVariants(): HasMany
    {
        return $this->hasMany(ProductVariant::class)->where('is_published', true);
    }
    
    /**
     * فرمت قیمت با واحد پول از config
     */
    public function getFormattedPriceAttribute(): string
    {
        $config = config('mahris.currency');
        
        return number_format(
            $this->price,
            $config['decimals'],
            $config['decimal_separator'],
            $config['thousands_separator']
        ) . ' ' . $config['unit'];
    }

    /**
     * قیمت پایین‌ترین نسخه منتشر شده
     */
    public function getMinPriceAttribute(): ?int
    {
        return $this->publishedVariants()->min('price');
    }

    /**
     * آیا حداقل یک نسخه موجود دارد؟
     */
    public function hasAvailableVariants(): bool
    {
        return $this->publishedVariants()
            ->where('stock', '>', 0)
            ->exists();
    }
}
