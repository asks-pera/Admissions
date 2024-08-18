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
        Schema::create('children', function (Blueprint $table) {
            $table->id();
            $table->string('surname');
            $table->string('other_names');
            $table->string('gender')->nullable();
            $table->date('dob');
            $table->string('present_school');
            $table->date('present_school_joined')->nullable();
            $table->string('previous_schools')->nullable();
            $table->string('grade_sought');
            $table->string('medium')->nullable();
            $table->string('religion');
            $table->string('denomination')->nullable();
            $table->date('baptism_date')->nullable();
            $table->string('other')->nullable();
            $table->string('picture');
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
        Schema::dropIfExists('children');
    }
};
