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
        Schema::create('facility_complete_request', function (Blueprint $table) {
            $table->bigIncrements('facilityCompleteRequestId');
            $table->unsignedBigInteger('mainteFacilityId');

            $table->date('MainteFacilityDate');
            $table->time('MainteFacilityTime');
            $table->string('RepairId');
            $table->string('FacilityBuildingName');
            $table->string('FacilityRoom');
            $table->string('FacilityType');
            $table->string('MainteFacilityReqUnit');
            $table->string('MainteFacilityReqFOR');

            $table->timestamps();

            $table->foreign('mainteFacilityId')
                ->references('mainteFacilityId')
                ->on('mainte_facility')        
                ->onDelete('cascade')         
                ->onUpdate('cascade');  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facility_complete_request');
    }
};
