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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->uuid('transactionId')->unique();
            $table->string('orderId');
            $table->string('referenceId');
            $table->string('class_code');
            $table->string('class_name');
            $table->string('payment_gateway');
            $table->string('status');
            $table->dateTime('order_created_at');
            $table->datetime('order_paid_at');
            $table->enum('payment_status', ['pending', 'on_process', 'paid', 'failed']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
