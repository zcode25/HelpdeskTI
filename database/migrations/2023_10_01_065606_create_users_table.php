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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('userId')->primary();
            $table->char('employeeId', 10)->unique();
            $table->foreign('employeeId')->references('employeeId')->on('employees')->onUpdate('cascade')->onDelete('restrict');
            $table->enum('role', ['Client', 'Admin', 'Technician', 'Manager']);
            $table->string('password');
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
        Schema::dropIfExists('users');
    }
};
