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
        Schema::create('message_details', function (Blueprint $table) {
            $table->uuid('messageDetailId')->primary();
            $table->uuid('messageId');
            $table->foreign('messageId')->references('messageId')->on('messages')->onUpdate('cascade')->onDelete('restrict');
            $table->string('messageSender', 100);
            $table->text('message');
            $table->dateTime('messageDate');
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
        Schema::dropIfExists('message_details');
    }
};
