<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWastProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wast_products', function (Blueprint $table) {
            $table->id();
            $table->string('asset_tag');
            $table->string('asset_type');
            $table->string('model');
            $table->string('purchase_date')->nullable();
            $table->string('description');
            $table->string('asset_sl_no')->nullable();
            $table->date('date');
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
        Schema::dropIfExists('wast_products');
    }
}
