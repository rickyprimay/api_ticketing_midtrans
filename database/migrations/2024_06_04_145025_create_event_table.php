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
        Schema::create('events', function (Blueprint $table) {
            $table->id('event_id')->primary();
            $table->unsignedBigInteger('users_id');
            $table->string('event_name');
            $table->text('event_description');
            $table->integer('price');
            $table->string('event_location');
            $table->string('event_picture')->nullable();
            $table->date('event_date');
            $table->date('event_start');
            $table->date('event_ended');
            $table->enum('event_type', ['event', 'health']);
            $table->string('sizing_picture')->nullable();
            $table->tinyInteger('event_status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
