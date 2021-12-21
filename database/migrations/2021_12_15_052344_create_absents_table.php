<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absents', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->integer('day');
            $table->integer('month');
            $table->integer('year');
            $table->time('enter');
            $table->time('out')->nullable();
            $table->integer('attend')->nullable()->default(null);
            $table->integer('permit')->nullable()->default(null);
            $table->integer('alpha')->nullable()->default(null);
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
        Schema::dropIfExists('absents');
    }
}
