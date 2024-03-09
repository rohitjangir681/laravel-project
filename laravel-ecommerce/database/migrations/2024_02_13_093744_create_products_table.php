<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('status')->nullable();
            $table->integer('is_featured')->nullable();
            $table->string('sku')->comment('(stock keeping unit)')->nullable();
            $table->double('qty', 8, 2)->comment('(quantity)')->nullable();
            $table->integer('stock_status')->nullable();
            $table->decimal('weight', 6, 2)->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->decimal('special_price', 10, 2)->nullable();
            $table->timestamp('special_price_from')->nullable();
            $table->timestamp('special_price_to')->nullable();
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->string('related_product')->nullable();
            $table->string('url_key')->nullable();
            $table->string('meta_tag')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
