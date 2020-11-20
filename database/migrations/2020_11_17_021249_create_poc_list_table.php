<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePocListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poc_list', function (Blueprint $table) {
            $table->integer('poc_id')->autoIncrement();
            $table->string('poc_name');
            $table->string('poc_path');
            $table->string('manufacturer');
            $table->string('type');
            $table->string('level');
            $table->string('href');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('poc_list');
    }
}
