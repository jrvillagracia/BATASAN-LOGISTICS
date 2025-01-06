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
        Schema::create('equipcondem', function (Blueprint $table) {
            $table->bigIncrements('equipcondemId');
            $table->string('EquipmentControlNo');
            $table->string('EquipmentBrandName');
            $table->string('EquipmentName');
            $table->string('EquipmentCategory');
            $table->string('EquipmentType');
            $table->string('EquipmentColor');
            $table->string('EquipmentUnit');
            $table->integer('EquipmentQuantity');
            $table->date('EquipmentDate');
            $table->decimal('EquipmentUnitPrice', 65, 2);
            $table->string('EquipmentClassification');
            $table->string('EquipmentSKU');
            $table->string('EquipmentSerialNo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipcondem');
    }
};
