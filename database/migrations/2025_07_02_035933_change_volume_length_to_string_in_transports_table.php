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
        Schema::table('transports', function (Blueprint $table) {
            $table->string('capacity')->nullable()->change();
            $table->string('volume')->nullable()->change();
            $table->string('length')->nullable()->change();
            $table->string('width')->nullable()->change();
            $table->string('height')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transports', function (Blueprint $table) {
            $table->unsignedInteger('capacity')->nullable()->change();
            $table->unsignedInteger('volume')->nullable()->change();
            $table->unsignedSmallInteger('length')->nullable()->change();
            $table->unsignedSmallInteger('width')->nullable()->change();
            $table->unsignedSmallInteger('height')->nullable()->change();
        });
    }
};
