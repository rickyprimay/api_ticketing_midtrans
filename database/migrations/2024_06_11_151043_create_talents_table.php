<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('talents', function (Blueprint $table) {
            $table->id('talent_id')->primary();
            $table->string('name'); 
            $table->string('talent_image')->nullable();
            $table->text('talent_description')->nullable();
            $table->unsignedBigInteger('event_id');
            $table->foreign('event_id')->references('event_id')->on('events')->onDelete('cascade');
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('talent');
    }
};
