<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCameraPassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('camera_passes', function (Blueprint $table) {
            $table->id();
            $table->string('camera_no')->nullable();
            $table->string('possition')->nullable();
            $table->string('password');
            $table->string('company')->nullable();
            $table->string('others')->nullable();
            $table->string('others1')->nullable();
            $table->string('others2')->nullable();
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
        Schema::dropIfExists('camera_passes');
    }
}
