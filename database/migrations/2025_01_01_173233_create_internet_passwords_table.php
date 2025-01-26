<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInternetPasswordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internet_passwords', function (Blueprint $table) {
            $table->id();
            $table->string('internet_name')->nullable();
            $table->string('position')->nullable();
            $table->string('password');
            $table->string('company')->nullable();
            $table->string('note')->nullable();
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
        Schema::dropIfExists('internet_passwords');
    }
}
