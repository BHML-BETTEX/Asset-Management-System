<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComputerPassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('computer_passes', function (Blueprint $table) {
            $table->id();
            $table->string('asset_tag');
            $table->string('emp_id')->nullable();
            $table->string('emp_name')->nullable();
            $table->string('password');
            $table->string('others')->nullable();
            $table->string('others1')->nullable();
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
        Schema::dropIfExists('computer_passes');
    }
}
