<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSysRefNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_ref_numbers', function (Blueprint $table) {
            $table->id();
            $table->string('ref_type');
            $table->string('cmp_node');
            $table->string('ref_year');
            $table->string('ref_month');
            $table->string('ref_prfx');
            $table->string('ref_nxt_seq');
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
        Schema::dropIfExists('sys_ref_numbers');
    }
}
