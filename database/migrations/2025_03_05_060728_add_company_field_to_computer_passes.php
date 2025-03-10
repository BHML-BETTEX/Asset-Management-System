<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCompanyFieldToComputerPasses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('computer_passes', function (Blueprint $table) {
            $table->string('company')->nullable()->after('emp_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('computer_passes', function (Blueprint $table) {
            $table->dropColumn('company');
        });
    }
}
