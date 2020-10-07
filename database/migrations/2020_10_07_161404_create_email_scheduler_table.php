<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailSchedulerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_scheduler', function (Blueprint $table) {
            $table->id();
            $table->string('email_alias');
            $table->string('email_subject');
            $table->string('email_body');
            $table->string('email_attach_file');
            $table->timestamp('send_date')->nullable();
            $table->string('send_status');
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
        Schema::dropIfExists('email_scheduler');
    }
}
