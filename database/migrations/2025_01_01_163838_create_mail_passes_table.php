<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailPassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mail_passes', function (Blueprint $table) {
            $table->id();
            $table->string('display_name')->nullable();
            $table->string('mail_address')->nullable();
            $table->string('password');
            $table->string('company')->nullable();
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
        Schema::dropIfExists('mail_passes');
    }
}
