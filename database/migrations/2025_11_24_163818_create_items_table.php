<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('sku')->unique();
            $table->unsignedInteger('quantity')->default(0);
            $table->enum('condition', ['good', 'repair', 'broken'])->default('good');
            $table->text('description')->nullable();
            $table->string('image_path')->nullable();
            $table->unsignedBigInteger('category_id')->nullable(); // 1 kategori per barang (lebih sederhana)
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
