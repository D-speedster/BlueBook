<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('publisher_id')->nullable()->constrained()->onDelete('set null');
            
            // مشخصات نسخه
            $table->string('name'); // نام نسخه (مثلاً: رقعی، جیبی)
            $table->string('translator')->nullable(); // مترجم
            $table->string('isbn')->nullable(); // شابک
            $table->string('size')->nullable(); // قطع
            $table->string('cover_type')->nullable(); // نوع جلد
            $table->integer('pages')->nullable(); // تعداد صفحات
            $table->integer('edition')->nullable(); // نوبت چاپ
            $table->integer('publish_year')->nullable(); // سال انتشار
            
            // قیمت و موجودی
            $table->unsignedBigInteger('price'); // قیمت به تومان
            $table->unsignedInteger('stock')->default(0); // موجودی
            
            // وضعیت
            $table->boolean('is_published')->default(true);
            $table->timestamps();
            
            $table->index(['product_id', 'is_published']);
            $table->index('publisher_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
