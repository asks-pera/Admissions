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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->boolean('mother_staff')->default(false);
            $table->boolean('father_staff')->default(false);
            $table->string('mother_name')->nullable();
            $table->string('father_name')->nullable();
            $table->date('mother_joined')->nullable();
            $table->date('father_joined')->nullable();
            $table->string('mother_section')->nullable();
            $table->string('father_section')->nullable();
            $table->string('mother_EPF')->nullable();
            $table->string('father_EPF')->nullable();
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
        Schema::dropIfExists('staff');
    }
};
