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
        Schema::create('others', function (Blueprint $table) {
            $table->id();
            $table->integer('num');
            $table->string('name_1')->nullable();
            $table->string('name_2')->nullable();
            $table->string('name_3')->nullable();
            $table->string('name_4')->nullable();
            $table->string('sex_1')->nullable();
            $table->string('sex_2')->nullable();
            $table->string('sex_3')->nullable();
            $table->string('sex_4')->nullable();
            $table->date('dob_1')->nullable();
            $table->date('dob_2')->nullable();
            $table->date('dob_3')->nullable();
            $table->date('dob_4')->nullable();
            $table->boolean('stc_1')->nullable();
            $table->boolean('stc_2')->nullable();
            $table->boolean('stc_3')->nullable();
            $table->boolean('stc_4')->nullable();
            $table->string('class_1')->nullable();
            $table->string('class_2')->nullable();
            $table->string('class_3')->nullable();
            $table->string('class_4')->nullable();
            $table->string('house_1')->nullable();
            $table->string('house_2')->nullable();
            $table->string('house_3')->nullable();
            $table->string('house_4')->nullable();
            $table->string('admission_1')->nullable();
            $table->string('admission_2')->nullable();
            $table->string('admission_3')->nullable();
            $table->string('admission_4')->nullable();
            $table->string('medium_1')->nullable();
            $table->string('medium_2')->nullable();
            $table->string('medium_3')->nullable();
            $table->string('medium_4')->nullable();
            $table->date('joined_1')->nullable();
            $table->date('joined_2')->nullable();
            $table->date('joined_3')->nullable();
            $table->date('joined_4')->nullable();
            $table->string('joinedgrade_1')->nullable();
            $table->string('joinedgrade_2')->nullable();
            $table->string('joinedgrade_3')->nullable();
            $table->string('joinedgrade_4')->nullable();
            $table->string('school_1')->nullable();
            $table->string('school_2')->nullable();
            $table->string('school_3')->nullable();
            $table->string('school_4')->nullable();
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
        Schema::dropIfExists('others');
    }
};
