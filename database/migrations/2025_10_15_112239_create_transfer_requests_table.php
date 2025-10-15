<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransferRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfer_requests', function (Blueprint $table) {
            $table->id();
            $table->string('asset_tag');
            $table->string('asset_type');
            $table->string('model')->nullable();
            $table->string('from_company'); // Original company
            $table->string('to_company');   // Receiving company
            $table->text('description')->nullable();
            $table->text('note')->nullable();
            $table->date('transfer_date');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->enum('item_status', ['transfer', 'borrowed'])->default('transfer'); // New field for borrowed items
            $table->string('requested_by')->nullable(); // Who initiated the transfer
            $table->string('approved_by')->nullable(); // Who approved/rejected
            $table->timestamp('approved_at')->nullable();
            $table->text('approval_notes')->nullable();
            $table->unsignedBigInteger('store_id')->nullable(); // Link to store record
            $table->timestamps();
            
            $table->index(['status', 'to_company']);
            $table->index(['from_company', 'asset_tag']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transfer_requests');
    }
}
