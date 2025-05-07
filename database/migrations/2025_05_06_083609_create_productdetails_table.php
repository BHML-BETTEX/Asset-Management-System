<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productdetails', function (Blueprint $table) {
            $table->id();
            $table->string('asset_type');
            $table->string('model')->nullable();
            $table->string('brand')->nullable();
            $table->string('description')->nullable();
            $table->string('asset_sl_no')->nullable();
            $table->string('qty');
            $table->string('units');
            $table->string('warrenty')->nullable();
            $table->string('durablity')->nullable();
            $table->string('cost')->nullable();
            $table->string('total')->nullable();
            $table->string('currency')->nullable();
            $table->string('vendor')->nullable();
            $table->string('purchase_date')->nullable();
            $table->string('challan_no')->nullable();
            $table->string('status')->nullable();
            $table->string('location')->nullable();
            $table->string('company')->nullable();
            $table->string('others')->nullable();
            $table->string('checkstatus')->nullable();
            $table->string('others2')->nullable();
            $table->string('others3')->nullable();
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
        Schema::dropIfExists('productdetails');
    }
}
