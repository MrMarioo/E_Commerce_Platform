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
        Schema::create('products_images', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId(column:'product_id')->constrained(table: 'products')->cascadeOnDelete();
            $table->string(column: 'image_path');
            $table->string(column:'alt_text')->nullable();
            $table->integer(column: 'sort_order' )->default(value: 0);

            $table->index(['product_id', 'sort_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products_images');
    }
};
