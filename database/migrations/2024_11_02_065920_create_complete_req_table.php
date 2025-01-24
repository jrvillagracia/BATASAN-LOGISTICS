<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('complete_req', function (Blueprint $table) {
            $table->id();
            $table->string('eventId');
            $table->time('EventApprTime');
            $table->date('EventApprDate');
            $table->string('EventApprRequestOffice');
            $table->string('EventApprRequestFor');
            $table->string('EventApprName');
            $table->date('StartEventApprDate');
            $table->date('EndEventApprDate');
            $table->time('StartEventApprTime');
            $table->time('EndEventApprTime');
            $table->string('EventsActBldName')->nullable();
            $table->string('EventsActRoom')->nullabe();
            $table->string('EventsActivityInventory');
            $table->string('EventActCategoryName');
            $table->string('EventActType');
            $table->string('EventActUnit');
            $table->integer('EventActQuantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complete_req');
    }
};
