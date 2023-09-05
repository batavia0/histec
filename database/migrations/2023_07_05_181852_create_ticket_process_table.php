<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_process', function (Blueprint $table) {
            $table->id('ticket_process_id');
            $table->unsignedBigInteger('ticket_id');
            $table->foreign('ticket_id')->references('ticket_id')->on('tickets')->onDelete('cascade');
            $table->unsignedBigInteger('ticket_process_status_id');
            $table->foreign('ticket_process_status_id')->references('status_id')->on('ticket_status');
            $table->unsignedBigInteger('technician_id');
            $table->foreign('technician_id')->references('id')->on('users');
            $table->string('name');
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_process');
    }
};
