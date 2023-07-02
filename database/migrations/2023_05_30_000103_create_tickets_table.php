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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id('ticket_id');
            $table->string('ticket_no');
            $table->string('name');
            $table->string('email');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('category_id')->on('category');
            $table->unsignedBigInteger('ticket_status_id');
            $table->foreign('ticket_status_id')->references('status_id')->on('ticket_status');
            $table->unsignedBigInteger('ticket_location_id');
            $table->foreign('ticket_location_id')->references('location_id')->on('locations');
            $table->text('description');
            $table->binary('image');
            $table->timestamps();
        });
        DB::statement('ALTER TABLE tickets MODIFY image MEDIUMBLOB;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
};
