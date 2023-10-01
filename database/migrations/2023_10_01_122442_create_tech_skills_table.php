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
        Schema::create('tech_skills', function (Blueprint $table) {
            $table->char('skillTechId', 5)->primary();
            $table->char('skillId', 5);
            $table->foreign('skillId')->references('skillId')->on('skills')->onUpdate('cascade')->onDelete('restrict');
            $table->uuid('userId');
            $table->foreign('userId')->references('userId')->on('users')->onUpdate('cascade')->onDelete('restrict');
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
        Schema::dropIfExists('tech_skills');
    }
};
