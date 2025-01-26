<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->id();
            $table->string('asset_tag')->nullable();
            $table->string('asset_type')->nullable();
            $table->string('model')->nullable();
            $table->string('description')->nullable();
            $table->string('emp_id')->nullable();
            $table->string('emp_name')->nullable();
            $table->string('designation_id')->nullable();
            $table->string('department_id')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->string('others')->nullable();
            $table->date('issue_date')->nullable();
            $table->date('return_date')->nullable();
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
        Schema::dropIfExists('issues');
    }
}
