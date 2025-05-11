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
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('sort_order')->nullable();
            $table->unsignedInteger('page_id')->nullable();
            $table->string('section_name');
            $table->string('type');
            $table->boolean('status')->default(true);
            $table->boolean('show_full')->default(false);
            $table->longText('markup')->nullable();
            $table->longText('data')->nullable();
            $table->unsignedInteger('added_by')->nullable();
            $table->unsignedInteger('modified_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};
