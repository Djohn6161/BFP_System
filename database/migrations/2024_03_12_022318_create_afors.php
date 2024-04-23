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
        Schema::create('afors', function (Blueprint $table) {
            $table->id();
            $table->string('alarm_received');
            $table->string('transmitted_by');
            $table->string('caller_address');
            $table->string('barangay_name');
            $table->string('zone');
            $table->string('location');
            $table->string('full_location');
            $table->foreignid('received_by')->constrained('personnels')->onUpdate('cascade');
            $table->dateTime('td_under_control')->nullable();
            $table->dateTime('td_declared_fireout')->nullable();
            $table->string('occupancy');
            $table->string('occupancy_specify');
            $table->string('distance_to_fire_incident');
            $table->string('structure_description');
            $table->string('sketch_of_fire_operation');
            $table->longText('details');
            $table->longText('problem_encounter');
            $table->longText('observation_recommendation');
            $table->string('alarm_status_arrival');
            $table->string('first_responder');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('afors');
    }
};
