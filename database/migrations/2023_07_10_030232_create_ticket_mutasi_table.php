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
        Schema::create('ticket_mutasi', function (Blueprint $table) {
            $table->id('ticket_mutasi_id');
            $table->unsignedBigInteger('ticket_id');
            $table->foreign('ticket_id')->references('ticket_id')->on('tickets');
            $table->unsignedBigInteger('technician_id');
            $table->foreign('technician_id')->references('id')->on('users');
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
        Schema::dropIfExists('ticket_mutasi');
    }
};
