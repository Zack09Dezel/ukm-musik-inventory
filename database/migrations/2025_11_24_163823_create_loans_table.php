<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('item_id');

            $table->unsignedInteger('quantity')->default(1);

            $table->date('borrowed_at')->nullable();
            $table->date('due_at')->nullable();
            $table->date('returned_at')->nullable();

            $table->enum('status', ['pending', 'approved', 'borrowed', 'returned'])->default('pending');

            $table->text('notes')->nullable();

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('item_id')->references('id')->on('items')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
