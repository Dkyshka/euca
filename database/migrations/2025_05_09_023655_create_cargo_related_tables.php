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
        Schema::create('cargo_types', function (Blueprint $table) {
            $table->id();
            $table->string('name_ru')->comment('Тип груза на рус.');
            $table->string('name_uz')->comment('Тип груза на узб.');
            $table->string('name_en')->comment('Тип груза на англ.');
            $table->timestamps();
            $table->comment('Типы грузов');
        });

        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name_ru');
            $table->string('name_uz');
            $table->string('name_en');
            $table->string('code');
            $table->timestamps();
        });

        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name_ru');
            $table->string('name_uz');
            $table->string('name_en');
            $table->timestamps();
        });

        Schema::create('cargo_loadings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->cascadeOnDelete();
            $table->foreignId('country_id')->nullable()->constrained('countries');
            $table->string('country')->nullable();
            $table->string('address')->nullable();
            $table->date('date_load_start')->nullable();
            $table->date('date_load_end')->nullable();
            $table->time('time_at')->nullable();
            $table->time('time_to')->nullable();
            $table->boolean('is_24h')->default(false);
            $table->string('final_unload_city')->nullable();
            $table->foreignId('final_unload_country_id')->nullable()->constrained('countries');
            $table->string('final_unload_country')->nullable();
            $table->string('final_unload_address')->nullable();
            $table->date('final_unload_date_from')->nullable();
            $table->date('final_unload_date_to')->nullable();
            $table->time('final_unload_datetime_from')->nullable();
            $table->time('final_unload_datetime_to')->nullable();
            $table->boolean('final_is_24h')->default(false);

            $table->boolean('is_archived')->default(false);
            $table->boolean('is_approved')->default(false);
            $table->boolean('is_top')->default(false);

            $table->json('body_types')->nullable();
            $table->json('loading_types')->nullable();
            $table->json('unloading_types')->nullable();
            $table->string('payment_type')->default('no_haggling')
                ->comment('no_haggling - без торга, negotiable - возможен торг, payment_request - запрос');
            $table->string('currency')->default('узб.сум');

            $table->unsignedInteger('with_vat_cashless')->nullable()->comment('С НДС, безнал');
            $table->unsignedInteger('without_vat_cashless')->nullable()->comment('Без НДС, безнал');
            $table->unsignedInteger('cash')->nullable()->comment('Наличными');
            $table->boolean('on_cart')->comment('на карту')->default(false);
            $table->boolean('counter_offers')->comment('видны только мне предложения')->default(false);
            $table->unsignedInteger('payment_via')->nullable();
            $table->text('note')->nullable();

            $table->foreignId('contact_id')->nullable()->constrained('users');
            $table->unsignedInteger('status')->default(1);
            $table->timestamps();
            $table->comment('Загрузка, от неё идёт основные привязки грузов');
        });

        Schema::create('cargos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cargo_loading_id')->constrained('cargo_loadings');

            $table->string('title')->nullable();
            $table->float('weight')->nullable(); // в кг или тоннах
            $table->float('volume')->nullable(); // м3
            $table->enum('weight_type', ['t', 'kg'])->default('t');

            $table->foreignId('package_id')->nullable()->constrained('packages'); // палеты, пачки
            $table->integer('quantity')->nullable()->comment('кол.во упаковки');
            $table->float('length')->nullable();
            $table->float('width')->nullable();
            $table->float('height')->nullable();
            $table->float('diameter')->nullable();

            $table->date('ready_date')->nullable();
            $table->integer('archive_after_days')->default(30);

            $table->enum('constant_frequency', ['daily', 'workdays'])->nullable();
            $table->timestamps();
        });

        Schema::create('cargo_photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cargo_id')->constrained()->cascadeOnDelete();
            $table->string('path');
            $table->timestamps();
        });

        Schema::create('cargo_unloadings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cargo_id')->constrained()->cascadeOnDelete();
            $table->string('unload_city');
            $table->foreignId('unload_country_id')->nullable()->constrained('countries');
            $table->string('unload_country')->nullable();
            $table->string('unload_address')->nullable();
            $table->enum('unload_type', ['by_weight', 'by_volume', 'mixed'])->default('mixed');
            $table->float('unload_weight')->nullable();
            $table->float('unload_volume')->nullable();
            $table->timestamp('unload_datetime_from')->nullable();
            $table->timestamp('unload_datetime_to')->nullable();
            $table->boolean('is_24h')->default(false);
            $table->boolean('is_final')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cargo_unloadings');
        Schema::dropIfExists('cargo_photos');
        Schema::dropIfExists('cargos');
        Schema::dropIfExists('cargo_loadings');
        Schema::dropIfExists('cargo_types');
        Schema::dropIfExists('countries');
        Schema::dropIfExists('packages');
    }
};
