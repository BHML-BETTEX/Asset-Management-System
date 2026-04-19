<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddUniqueBrandNameToBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('brands', function (Blueprint $table) {
            // Remove duplicates, keeping the one with the smallest id
            DB::statement('DELETE b1 FROM brands b1 INNER JOIN brands b2 WHERE b1.id > b2.id AND b1.brand_name = b2.brand_name');
            $table->unique('brand_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('brands', function (Blueprint $table) {
            $table->dropUnique(['brand_name']);
        });
    }
}
