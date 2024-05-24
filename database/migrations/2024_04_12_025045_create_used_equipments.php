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
            $table->foreignId('afor_id')->constrained('afors')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('quantity')->nullable();
            $table->enum('category', ['extinguishing agent','rope and ladder','breathing apparatus','hose line']);
            $table->string('type');
            $table->string('nr')->nullable();   
            $table->string('length')->nullable();
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
