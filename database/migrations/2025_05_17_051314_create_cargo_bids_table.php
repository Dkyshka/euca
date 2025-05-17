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
        Schema::create('cargo_bids', function (Blueprint $table) {
            $table->id();

            $table->foreignId('cargo_loading_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->unsignedInteger('price')->nullable()->comment('Предложенная ставка');
            $table->string('currency')->default('узб.сум'); // или можно enum
            $table->boolean('is_negotiable')->default(false)->comment('Флаг: торг возможен');
            $table->text('comment')->nullable()->comment('Комментарий пользователя');

            $table->enum('status', ['pending', 'accepted', 'declined'])->default('pending')->comment('Статус предложения');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cargo_bids');
    }
};
