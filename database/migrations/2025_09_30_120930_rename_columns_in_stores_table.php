<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stores', function (Blueprint $table) {
            // Rename multiple columns at once
            if (Schema::hasColumn('stores', 'products_id')) {
                $table->renameColumn('products_id', 'asset_tag');
            }
            if (Schema::hasColumn('stores', 'brand')) {
                $table->renameColumn('brand', 'brand_id');
            }
            if (Schema::hasColumn('stores', 'units')) {
                $table->renameColumn('units', 'units_id');
            }
            if (Schema::hasColumn('stores', 'status')) {
                $table->renameColumn('status', 'status_id');
            }
            if (Schema::hasColumn('stores', 'company')) {
                $table->renameColumn('company', 'company_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stores', function (Blueprint $table) {
            // Rollback column names to original
            if (Schema::hasColumn('stores', 'asset_tag')) {
                $table->renameColumn('asset_tag', 'products_id');
            }
            if (Schema::hasColumn('stores', 'brand_id')) {
                $table->renameColumn('brand_id', 'brand');
            }
            if (Schema::hasColumn('stores', 'units_id')) {
                $table->renameColumn('units_id', 'units');
            }
            if (Schema::hasColumn('stores', 'status_id')) {
                $table->renameColumn('status_id', 'status');
            }
            if (Schema::hasColumn('stores', 'company_id')) {
                $table->renameColumn('company_id', 'company');
            }
        });
    }
};
