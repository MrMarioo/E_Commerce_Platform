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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string(column: 'name');
            $table->string(column: 'slug')->unique();
            $table->text(column: 'description')->nullable();
            $table->enum(column: 'status', allowed: \App\Enum\StatuseEnum::values())->default(value: \App\Enum\StatuseEnum::ACTIVE->value);;
            $table->integer(column: 'sort_order' )->default(value: 0);
            $table->foreignId(column: 'parent_id')->nullable()->constrained('categories')->onDelete('restrict');
            $table->index(['parent_id', 'sort_order']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
