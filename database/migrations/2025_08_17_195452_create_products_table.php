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
            $table->timestamps();
            $table->string(column: 'name');
            $table->string(column: 'sku')->unique();
            $table->text(column: 'description');
            $table->decimal(column: 'price', total: 8, places: 2);
            $table->integer(column: 'stock_quantity')->default(0);
            $table->decimal(column: 'weight', total: 8, places: 3)->nullable();
            $table->json(column: 'attributes')->nullable();
            $table->enum(column: 'status', allowed: \App\Enum\StatuseEnum::values())->default(value: \App\Enum\StatuseEnum::ACTIVE->value);;

            $table->index(['sku']);
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
