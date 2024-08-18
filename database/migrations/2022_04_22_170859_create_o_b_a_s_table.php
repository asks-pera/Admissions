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
        Schema::create('o_b_a_s', function (Blueprint $table) {
            $table->id();
            $table->boolean('mount')->default(false);
            $table->boolean('guru')->default(false);
            $table->boolean('banda')->default(false);
            $table->boolean('prep')->default(false);
            $table->date('mount_from')->nullable();
            $table->date('mount_to')->nullable();
            $table->date('guru_from')->nullable();
            $table->date('guru_to')->nullable();
            $table->date('banda_from')->nullable();
            $table->date('banda_to')->nullable();
            $table->date('prep_from')->nullable();
            $table->date('prep_to')->nullable();
            $table->string('house')->nullable();
            $table->string('admission')->nullable();
            $table->boolean('oba_member')->default(false);
            $table->date('oba_date')->nullable();
            $table->string('oba_number')->nullable();
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
        Schema::dropIfExists('o_b_a_s');
    }
};
