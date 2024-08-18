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
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();
            $table->string('section');
            $table->string('name');
            $table->string('nic');
            $table->string('mobile');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('branch')->nullable();
            $table->boolean('purchased')->default(0);
            $table->boolean('submitted')->default(0);
            $table->dateTime('purchased_date')->nullable();
            $table->dateTime('submitted_date')->nullable();
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
        Schema::dropIfExists('applicants');
    }
};
