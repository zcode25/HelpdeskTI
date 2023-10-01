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
        Schema::create('employees', function (Blueprint $table) {
            $table->char('employeeId', 10)->primary();
            $table->string('name', 50);
            $table->char('divisionId', 5);
            $table->foreign('divisionId')->references('divisionId')->on('divisions')->onUpdate('cascade')->onDelete('restrict');
            $table->string('email', 50);
            $table->string('tel', 15)->unique();
            $table->string('address', 200);
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
        Schema::dropIfExists('employees');
    }
};
