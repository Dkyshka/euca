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
        Schema::table('cargo_bids', function (Blueprint $table) {
            $table->foreignId('transport_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cargo_bids', function (Blueprint $table) {
            $table->dropForeign(['transport_id']);
            $table->dropColumn('transport_id');
        });
    }
};
