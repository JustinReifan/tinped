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
        Schema::create('history_orders', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address');
            $table->string('trxid');
            $table->string('provider');
            $table->string('type');
            $table->integer('service_id');
            $table->string('layanan');
            $table->string('target');
            $table->string('quantity');
            $table->string('price');
            $table->string('start_count');
            $table->string('remains');
            $table->enum('status', ['pending', 'processing', 'done', 'partial', 'error']);
            $table->enum('refill', ['1', '0']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_orders');
    }
};
