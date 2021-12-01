<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDispatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispatches', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('caller_phone');
            $table->string('victim_name');
            $table->char('victim_gender');
            $table->string('kin_name');
            $table->string('kin_phone');
            $table->integer('location_id');
            $table->integer('ambulance_id');
            $table->text('emergency_details');
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
        Schema::dropIfExists('dispatches');
    }
}
