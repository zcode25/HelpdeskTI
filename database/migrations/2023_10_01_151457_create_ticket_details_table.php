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
        Schema::create('ticket_details', function (Blueprint $table) {
            $table->uuid('ticketDetailId')->primary();
            $table->uuid('ticketId');
            $table->foreign('ticketId')->references('ticketId')->on('tickets')->onUpdate('cascade')->onDelete('restrict');
            $table->enum('status', ['Sent', 'Accepted', 'On Hold', 'Rejected', 'Complaint Accepted', 'Complaint On Hold', 'Complaint Rejected', 'Complaint Assignment', 'Assignment', 'Worked on', 'Validation', 'Complaint', 'Done']);
            $table->string('statusDesc', 200);
            $table->string('statusNote', 200);
            $table->date('statusDate');
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
        Schema::dropIfExists('ticket_details');
    }
};
