<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesktopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('desktops', function (Blueprint $table) {
            $table->id();
            $table->string('products_id');
            $table->string('model_no');
            $table->string('product_sl_no')->nullable();
            $table->string('product_details')->nullable();
            $table->string('emp_id')->nullable();
            $table->string('emp_name');
            $table->string('designation_id')->nullable();
            $table->string('department_id')->nullable();
            $table->string('issue_date');
            $table->string('phone_number')->nullable();
            $table->string('picture')->nullable();
            $table->string('others')->nullable();
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
        Schema::dropIfExists('desktops');
    }
}
