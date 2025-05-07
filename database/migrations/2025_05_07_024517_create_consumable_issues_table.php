<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsumableIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consumable_issues', function (Blueprint $table) {
            $table->id();
            $table->date('issue_date');
            $table->integer('product_type');
            $table->integer('model_id')->nullable();
            $table->integer('issue_qty');
            $table->integer('units_id')->nullable();
            $table->integer('emp_id')->nullable();
            $table->integer('department_id')->nullable();
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
        Schema::dropIfExists('consumable_issues');
    }
}
