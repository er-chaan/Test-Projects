<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('task_name')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('duration')->nullable();
            $table->integer('dependancy_task')->nullable();
            $table->string('dependancy_condition')->nullable();
            $table->integer('dependancy_days')->nullable();
            $table->text('description')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('tasks');
    }
}
