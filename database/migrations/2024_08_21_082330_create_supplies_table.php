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
            $table->string('SuppliesName');
            $table->string('SuppliesCategory');
            $table->integer('SuppliesQuantity');
            $table->date('SuppliesDate');
            $table->decimal('SuppliesPrice', 65, 2);
            $table->string('SuppliesDepartment');
            $table->string('SuppliesSKU');
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