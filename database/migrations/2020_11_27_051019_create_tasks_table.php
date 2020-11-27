<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->text('description');
            $table->text('client_name')->nullable();
            $table->text('client_org')->nullable();
            $table->text('client_phone');
            $table->text('car_name')->nullable();
            $table->text('car_number');
            $table->unsignedBigInteger('create_by');
            $table->unsignedBigInteger('edit_by');
            $table->foreign('create_by')->references('id')->on('users');
            $table->foreign('edit_by')->references('id')->on('users');
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
