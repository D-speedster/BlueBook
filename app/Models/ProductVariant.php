<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductVariant extends Model
{
    protected $fillable = [
        'product_id',
        'publisher_id',
        'name',
        'translator',
        'isbn',
        'size',
        'cover_type',
        'pages',
        'edition',
        'publish_year',
        'price',
        'stock',
        'is_published',
    ];

    protected $casts = [
        'price' => 'integer',
        'stock' => 'integer',
        'pages' => 'integer',
        'edition' => 'integer',
        'publish_year' => 'integer',
        'is_published' => 'boolean',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function publisher(): BelongsTo
    {
        return $this->belongsTo(Publisher::class);
    }

    /**
     * فرمت قیمت به تومان
     */
    public function getFormattedPriceAttribute(): string
    {
        return number_format($this->price) . ' تومان';
    }

    /**
     * بررسی موجودی
     */
    public function isAvailable(): bool
    {
        return $this->is_published && $this->stock > 0;
    }
}
