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
        Schema::create('supplies', function (Blueprint $table) {
            $table->id();
            $table->string('SuppliesControlNo');
            $table->string('SuppliesBrandName');
            $table->string('SuppliesName');
            $table->string('SuppliesCategory');
            $table->string('SuppliesType');
            $table->string('SuppliesColor');
            $table->string('SuppliesUnit');
            $table->integer('SuppliesQuantity');
            $table->date('SuppliesDate');
            $table->decimal('SuppliesUnitPrice', 65, 2);
            $table->string('SuppliesClassification');
            $table->string('SuppliesSKU');
            $table->string('SuppliesSerialNo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplies');
    }
};
