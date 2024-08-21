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
        Schema::create('equipment', function (Blueprint $table) {
            $table->id();
            $table->string('EquipmenttName');
            $table->string('EquipmentCategory');
            $table->integer('EquipmentQuantity');
            $table->date('EquipmentDate');
            $table->decimal('EquipmentPrice', 65, 2);
            $table->string('EquipmentDepartment');
            $table->string('EquipmentSKU');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment');
    }
};
