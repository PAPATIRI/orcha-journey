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
        Schema::create('tbl_travel_package', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('price')->default(0);
            $table->bigInteger('original_price')->default(0)->nullable();
            $table->integer('discount_percentage')->nullable();
            $table->boolean('is_best_choice')->default(false);
            $table->json('destination_list')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_travel_package');
    }
};
