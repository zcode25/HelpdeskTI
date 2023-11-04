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
            $table->uuid('ticketId')->primary();
            $table->char('ticketNumber', 20);
            $table->dateTime('ticketDate');
            $table->uuid('clientId');
            $table->foreign('clientId')->references('userId')->on('users')->onUpdate('cascade')->onDelete('restrict');
            $table->uuid('techId');
            $table->foreign('techId')->references('userId')->on('users')->onUpdate('cascade')->onDelete('restrict');
            $table->string('request', 200);
            $table->string('requestDesc', 255);
            $table->string('requestPict', 50);
            $table->char('categoryId', 5);
            $table->foreign('categoryId')->references('categoryId')->on('categories')->onUpdate('cascade')->onDelete('restrict');
            $table->dateTime('expecDone');
            $table->enum('priority', ['low', 'middle', 'high']);
            $table->enum('status', ['Sent', 'Accepted', 'On Hold', 'Rejected', 'Complaint Accepted', 'Complaint On Hold', 'Complaint Rejected', 'Complaint Assignment', 'Assignment', 'Worked on', 'Validation', 'Complaint', 'Done']);
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
        Schema::dropIfExists('tickets');
    }
};
