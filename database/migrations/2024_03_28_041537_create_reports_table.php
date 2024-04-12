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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_leaders_id')->constrained('personnels')->onUpdate('cascade');
            $table->foreignId('drivers_id')->constrained('personnels')->onUpdate('cascade');
            $table->foreignId('trucks_id')->constrained('trucks')->onUpdate('cascade');
            $table->enum('category', ['Investigation', 'Operation']);
            $table->enum('type', ['Fire Incident', 'Vehicular Accident', 'Non-Emergency Response']);
            $table->dateTime('time_of_departure');
            $table->dateTime('time_of_arrival_to_scene');
            $table->string('name');
            $table->string('street')->nullable();
            $table->string('otherLocation')->nullable();
            $table->string('property_involved')->nullable();
            $table->float('estimate_cost_of_damages')->nullable();
            $table->longText('remarks')->nullable();
            $table->longText('photos')->nullable();
            $table->dateTime('time_of_arrival_to_station');
            $table->boolean('deleted_at')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
