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
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id')->primary();
            $table->bigInteger('event_id');
            $table->string('external_id');
            $table->string('name_buyer');
            $table->string('email_buyer');
            $table->string('no_transaction');
            $table->string('item_name')->default('ticket');
            $table->integer('qty');
            $table->integer('price');
            $table->bigInteger('total_amount');
            $table->string('status')->default('pending');
            $table->string('invoice_url');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone_number');
            $table->date('birth_date');
            $table->enum('gender', ['Male', 'Female'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
