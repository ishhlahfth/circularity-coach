<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Freeassessment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('freeassessment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained();
            $table->datetime('fu_date')->nullable();
            $table->datetime('responded_date')->nullable();
            $table->datetime('appointment_date')->nullable();
            $table->datetime('completed_date')->nullable();
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
        //
    }
}
