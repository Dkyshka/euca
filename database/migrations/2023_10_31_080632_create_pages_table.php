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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('parent_id')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->string('name_ru');
            $table->string('name_uz')->nullable();
            $table->string('name_en')->nullable();
            $table->string('slug')->unique();
            $table->string('slug_name')->unique();
            $table->tinyInteger('status')->default(1);
            $table->string('meta_title_ru')->nullable();
            $table->string('meta_title_uz')->nullable();
            $table->string('meta_title_en')->nullable();
            $table->mediumText('description_ru')->nullable();
            $table->mediumText('description_uz')->nullable();
            $table->mediumText('description_en')->nullable();
            $table->boolean('header')->default(false);
            $table->boolean('footer')->default(false);
            $table->string('type_content')->nullable();
            $table->string('template_name')->default('default');
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
        Schema::dropIfExists('pages');
    }
};
