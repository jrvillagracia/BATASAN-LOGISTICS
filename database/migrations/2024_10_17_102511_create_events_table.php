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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('eventId')->nullable();
            $table->time('EventApprTime');
            $table->date('EventApprDate');
            $table->string('EventApprRequestOffice');
            $table->string('EventApprRequestFor');
            $table->string('EventApprName');
            $table->date('StartEventApprDate');
            $table->date('EndEventApprDate');
            $table->time('StartEventApprTime');
            $table->time('EndEventApprTime');
            $table->string('EventApprLocation');
            $table->string('EventApprProductName');
            $table->integer('EventApprQuantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
