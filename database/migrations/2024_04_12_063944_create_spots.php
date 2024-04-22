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
        Schema::create('spots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('investigation_id')->constrained('investigations')->onUpdate('cascade');
            $table->string('time');
            $table->string('address');
            $table->string('involved');
            $table->string('name_of_establishment');
            $table->string('owner');
            $table->string('occupant');
            $table->float('estimate_damage');
            $table->string('time_fire_start');
            $table->string('time_fire_out');
            $table->longText('details');
            $table->longText('disposition');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spots');
    }
};
