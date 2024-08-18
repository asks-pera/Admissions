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
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->boolean('scholexam')->default(false);
            $table->string('scholindex')->nullable();
            $table->string('scholmark')->nullable();
            $table->string('olindex')->nullable();
            $table->string('olreligion')->nullable();
            $table->string('olfirstlang')->nullable();
            $table->string('olenglish')->nullable();
            $table->string('olscience')->nullable();
            $table->string('olmath')->nullable();
            $table->string('olhistory')->nullable();
            $table->string('olbasket1subject')->nullable();
            $table->string('olbasket1result')->nullable();
            $table->string('olbasket2subject')->nullable();
            $table->string('olbasket2result')->nullable();
            $table->string('olbasket3subject')->nullable();
            $table->string('olbasket3result')->nullable();
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
        Schema::dropIfExists('results');
    }
};
