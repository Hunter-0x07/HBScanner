<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePocScanResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poc_scan_results', function (Blueprint $table) {
            $table->integer('vul_id')->autoIncrement();
            $table->integer('task_id');
            $table->integer('poc_id');
            $table->foreign('poc_id')
                ->references('poc_id')
                ->on('poc_list')
                ->onDelete("cascade");
            $table->foreign('task_id')
                ->references('task_id')
                ->on('poc_scan_tasks')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('poc_scan_results');
    }
}
