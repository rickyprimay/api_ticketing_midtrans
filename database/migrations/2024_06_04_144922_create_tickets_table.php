<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up() {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id('ticket_id')->primary();
            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('events_id');
            $table->integer('price');
            $table->string('qr_code_ticket')->nullable();
            $table->tinyInteger('ticket_status')->default(0);
            $table->tinyInteger('payment_status')->default(0);
            $table->timestamps();
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
