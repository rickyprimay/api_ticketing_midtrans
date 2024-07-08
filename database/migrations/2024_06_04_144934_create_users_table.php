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
        Schema::create('users', function (Blueprint $table) {
            $table->id('users_id')->primary();
            $table->uuid('users_uuid')->unique();
            $table->string('name');
            $table->date('birth_date')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('gender', ['Male', 'Female'])->nullable();
            $table->string('phone_number')->nullable();
            $table->tinyInteger('role')->default(0);
            $table->integer('otp')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('otp_sent_at')->nullable();
            // $table->string('password_reset_tokens')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
