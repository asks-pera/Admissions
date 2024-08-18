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
        Schema::create('statuses', function (Blueprint $table) {
            $table->id();
            $table->boolean('purchased')->default(false);
            $table->boolean('child')->default(false);
            $table->boolean('father')->default(false);
            $table->boolean('mother')->default(false);
            $table->boolean('other')->default(false);
            $table->boolean('results')->default(false);
            $table->boolean('church')->default(false);
            $table->boolean('subjects')->default(false);
            $table->boolean('oba')->default(false);
            $table->boolean('staff')->default(false);
            $table->boolean('connections')->default(false);
            $table->boolean('general')->default(false);
            $table->boolean('submitted')->default(false);
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
        Schema::dropIfExists('statuses');
    }
};
