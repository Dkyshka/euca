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
        Schema::create('transports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->foreignId('driver_id')->nullable()->constrained()->nullOnDelete();

            $table->string('body_type')->nullable(); // 🔹 тип кузова
            $table->unsignedInteger('capacity')->nullable();         // 🔹 грузоподъёмность, кг
            $table->unsignedInteger('volume')->nullable();           // 🔹 объём кузова, м³
            $table->string('country');
            $table->string('final_country')->nullable();

            $table->unsignedSmallInteger('length')->nullable();      // 🔹 длина кузова, см
            $table->unsignedSmallInteger('width')->nullable();       // 🔹 ширина кузова, см
            $table->unsignedSmallInteger('height')->nullable();      // 🔹 высота кузова, см

            $table->unsignedInteger('with_vat_cashless')->nullable()->comment('С НДС, безнал');
            $table->unsignedInteger('without_vat_cashless')->nullable()->comment('Без НДС, безнал');
            $table->unsignedInteger('cash')->nullable()->comment('Наличными');

            $table->string('currency')->default('узб.сум');

            $table->enum('availability_mode', ['date', 'workdays', 'weekends', 'daily'])->nullable()->default('date');
            $table->date('ready_date')->nullable(); // если availability_mode = date

            $table->enum('payment_type', ['no_haggling', 'payment_request'])->default('payment_request'); // 🔹 тип оплаты
            $table->text('comment')->nullable(); // 🔹 примечание

            $table->string('type')->nullable();              // старое поле: тип транспорта
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transports');
    }
};
