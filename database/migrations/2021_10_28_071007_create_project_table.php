<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project', function (Blueprint $table) {
            $table->integer('client_id');
            $table->integer('employee_id');
            $table->integer('project_id');
            $table->string('project_details');
            $table->string('project_name');
            $table->datetime('start');
            $table->datetime('pause');
            $table->datetime('end');
            $table->integer('difference');
            $table->double('due');
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
        Schema::dropIfExists('project');
    }
}
