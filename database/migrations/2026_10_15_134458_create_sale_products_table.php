<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sale_products', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('slug')->unique();
            $table->string('sku')->nullable()->unique();
            $table->string('category')->nullable();

            $table->string('short_description', 500)->nullable();
            $table->longText('description')->nullable();

            $table->string('image_path')->nullable();

            $table->decimal('price', 12, 2)->nullable();
            $table->boolean('is_price_visible')->default(true);

            $table->boolean('is_available')->default(true);
            $table->unsignedInteger('stock_quantity')->default(0);

            $table->boolean('is_published')->default(false);
            $table->unsignedInteger('display_order')->default(0);

            $table->timestamps();
            $table->softDeletes();

            $table->index(['is_published', 'is_available']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sale_products');
    }
};
