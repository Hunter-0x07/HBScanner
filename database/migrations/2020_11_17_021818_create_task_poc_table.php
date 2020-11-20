<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskPocTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_poc', function (Blueprint $table) {
            $table->id();
            $table->integer('task_id');
            $table->integer('poc_id');
            $table->foreign('task_id')
                ->references('task_id')
                ->on('poc_scan_tasks')
                ->onDelete("cascade");
            $table->foreign('poc_id')
                ->references('poc_id')
                ->on('poc_list')
                ->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_poc');
    }
}
