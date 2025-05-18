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
            $table->unsignedInteger('with_vat_cashless')->nullable()->comment('С НДС, безнал');
            $table->unsignedInteger('without_vat_cashless')->nullable()->comment('Без НДС, безнал');
            $table->unsignedInteger('cash')->nullable()->comment('наличными');

            $table->string('currency')->nullable()->default('узб.сум'); // или можно enum
            $table->text('comment')->nullable()->comment('Комментарий пользователя');

            $table->enum('status', ['pending', 'accepted', 'declined', 'finished'])->default('pending')->comment('Статус предложения');

            // Новые поля:
            $table->boolean('is_prepayment')->default(false)->comment('Предоплата');
            $table->unsignedTinyInteger('prepayment_percent')->nullable()->comment('% предоплаты');

            $table->boolean('is_on_unloading')->default(false)->comment('На выгрузке');
            $table->boolean('is_bank_transfer')->default(false)->comment('Через банк');
            $table->unsignedSmallInteger('bank_transfer_days')->nullable()->comment('Дней на оплату через банк');

            $table->text('payment_comment')->nullable()->comment('Комментарий по оплате');
            $table->date('ready_date')->nullable()->comment('Дата готовности');

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
