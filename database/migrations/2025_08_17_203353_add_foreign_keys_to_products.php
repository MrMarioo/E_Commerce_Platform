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
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId(column:'category_id')->constrained(table: 'categories')->cascadeOnDelete();
            $table->foreignId(column:'brand_id')->constrained(table: 'brands')->cascadeOnDelete();


            $table->index(['category_id', 'status']);
            $table->index(['brand_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex(['category_id', 'status']);
            $table->dropIndex(['brand_id', 'status']);

            $table->dropForeign(['category_id']);
            $table->dropForeign(['brand_id']);
        });
    }
};
