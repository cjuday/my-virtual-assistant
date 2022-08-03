<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotifyClientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notify_client', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id');
            $table->string('project_name');
            $table->string('notification_text');
            $table->date('started');
            $table->date('paused');
            $table->date('resumed');
            $table->date('ended');
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
        Schema::dropIfExists('notify_client');
    }
}
