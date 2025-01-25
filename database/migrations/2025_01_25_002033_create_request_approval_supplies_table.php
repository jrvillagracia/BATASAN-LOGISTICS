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
        Schema::create('request_approval_supplies', function (Blueprint $table) {
            $table->bigIncrements('requestApprovalId');
            $table->string('RepairRequestId');
            $table->date('ReqSuppDate');
            $table->time('ReqSuppTime');
            $table->string('ReqSuppliesRequestOffice');
            $table->string('ReqSuppBldName');
            $table->string('ReqSuppRoom');
            $table->string('ReqSupRequestFOR');
            $table->string('ReqSupCategoryName');
            $table->string('ReqSupType');
            $table->string('ReqSupUnit');
            $table->integer('ReqSupQuantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_approval_supplies');
    }
};
