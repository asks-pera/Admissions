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
        Schema::create('mothers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('occupation');
            $table->string('employment');
            $table->string('mobile');
            $table->string('email');
            $table->string('address');
            $table->string('religion');
            $table->string('denomination')->nullable();
            $table->date('baptism_date')->nullable();
            $table->string('other')->nullable();
            $table->string('nic');
            $table->string('old_school');
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
        Schema::dropIfExists('mothers');
    }
};
