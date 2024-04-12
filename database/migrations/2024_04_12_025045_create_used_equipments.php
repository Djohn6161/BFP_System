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
        Schema::create('used_equipments', function (Blueprint $table) {
            $table->id();
            $table->foreign('afor_id');
            $table->int('quantity');
            $table->enum('category', ['extinguishing agent','rope and ladder','breathing apparatus','hose line']);
            $table->string('type');
            $table->string('nr')->nullable();
            $table->int('length')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('used_equipments');
    }
};
