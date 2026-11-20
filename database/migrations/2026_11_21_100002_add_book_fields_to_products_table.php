<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // اضافه کردن فیلدهای مربوط به کتاب
            $table->json('authors')->nullable()->after('title'); // لیست نویسندگان
            $table->string('cover_image')->nullable()->after('image'); // تصویر جلد
            $table->text('summary')->nullable()->after('description'); // خلاصه کتاب
            
            // حذف فیلدهای قدیمی که به نسخه منتقل می‌شوند
            // price و stock را نگه می‌داریم برای سازگاری
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['authors', 'cover_image', 'summary']);
        });
    }
};
