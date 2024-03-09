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
        Schema::create('quotes_items', function (Blueprint $table) {
            $table->id();
            $table->integer('quote_id');
            $table->integer('product_id');
            $table->string('name')->nullable();
            $table->string('sku')->comment('[Stock keeping unit]')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->integer('qty')->comment('[quantity]')->nullable();
            $table->decimal('row_total', 10, 2)->nullable();
            $table->string('custom_option')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotes_items');
    }
};
