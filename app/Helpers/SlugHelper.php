<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class SlugHelper
{
    /**
     * تولید slug از متن فارسی بدون رومی‌سازی
     * 
     * @param string $text
     * @return string
     */
    public static function make(string $text): string
    {
        // حذف کاراکترهای خاص و نگه‌داشتن حروف فارسی، انگلیسی، اعداد و فاصله
        $slug = preg_replace('/[^\p{Arabic}\p{L}\p{N}\s-]/u', '', $text);
        
        // تبدیل فاصله‌های متوالی به یک فاصله
        $slug = preg_replace('/\s+/', ' ', $slug);
        
        // trim و تبدیل فاصله به خط تیره
        $slug = trim($slug);
        $slug = str_replace(' ', '-', $slug);
        
        // حذف خط تیره‌های متوالی
        $slug = preg_replace('/-+/', '-', $slug);
        
        // حذف خط تیره ابتدا و انتها
        $slug = trim($slug, '-');
        
        return $slug;
    }
    
    /**
     * تولید slug یکتا برای یک مدل
     * 
     * @param string $text
     * @param string $modelClass
     * @param string $field
     * @param int|null $ignoreId
     * @return string
     */
    public static function makeUnique(
        string $text,
        string $modelClass,
        string $field = 'slug',
        ?int $ignoreId = null
    ): string {
        $slug = self::make($text);
        $originalSlug = $slug;
        $counter = 1;
        
        while (self::slugExists($slug, $modelClass, $field, $ignoreId)) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }
        
        return $slug;
    }
    
    /**
     * بررسی وجود slug در دیتابیس
     */
    private static function slugExists(
        string $slug,
        string $modelClass,
        string $field,
        ?int $ignoreId
    ): bool {
        $query = $modelClass::where($field, $slug);
        
        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }
        
        return $query->exists();
    }
}
