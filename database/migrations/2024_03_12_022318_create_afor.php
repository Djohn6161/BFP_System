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
        Schema::create('afor', function (Blueprint $table) {
            $table->id();
            $table->string('alarm_received');
            $table->foreignid('transmitted_by')->constrained('personnels')->onUpdate('cascade');
            $table->string('caller_address');
            $table->foreignId('barangay_id')->constrained('barangays')->onUpdate('cascade');
            $table->string('zone');
            $table->string('location');
            $table->foreignid('received_by')->constrained('personnels')->onUpdate('cascade');
            $table->dateTime('td_under_control');
            $table->dateTime('td_declared_fireout');
            $table->enum('occupancy',['s','ns','v']);
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
        Schema::dropIfExists('afor');
    }
};
