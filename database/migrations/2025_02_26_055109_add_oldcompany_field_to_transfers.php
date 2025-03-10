<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOldcompanyFieldToTransfers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transfers', function (Blueprint $table) {
            $table->string('oldcompany')->nullable()->after('model');
            $table->string('others')->nullable()->after('oldcompany');
            $table->date('return_date')->nullable()->after('transfer_date');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transfers', function (Blueprint $table) {
            $table->dropColumn('oldcompany');
            $table->dropColumn('others');
            $table->dropColumn('return_date');
        });
    }
}
