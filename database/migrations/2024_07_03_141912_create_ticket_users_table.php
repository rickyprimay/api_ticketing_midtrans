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
        Schema::create('ticket_users', function (Blueprint $table) {
            $table->id();
            $table->string('users_name');
            $table->unsignedBigInteger('events_id');
            $table->string('qr_code_ticket')->nullable();
            $table->tinyInteger('ticket_status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_users');
    }
};
