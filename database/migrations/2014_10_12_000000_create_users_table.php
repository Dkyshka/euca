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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('chat_id')->nullable();
            $table->unsignedInteger('inviter_id')->nullable();
            $table->string('name')->nullable();
            $table->string('full_name')->nullable();
            $table->string('username')->nullable();
            $table->string('phone')->nullable();
            $table->string('pinfl')->nullable();
            $table->string('passport_number')->nullable();
            $table->string('email')->unique()->nullable();
            $table->unsignedTinyInteger('role_id')->default(1);
            $table->unsignedTinyInteger('status')->default(1);
            $table->string('avatar')->nullable();
            $table->string('password')->nullable();
            $table->string('step')->nullable();
            $table->string('lang')->default('ru');
            $table->integer('bonus_balance')->default(0);
            $table->integer('bonus_invites')->default(0);
            $table->boolean('is_confirm')->default(false);
            $table->string('login');
            $table->string('organization')->nullable();
            $table->string('inn')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->index('chat_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
