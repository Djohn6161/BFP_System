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
        Schema::create('minimals', function (Blueprint $table) {
            $table->id();
            $table->foreignid('investigation_id')->constrained('investigations')->onUpdate('cascade');
            $table->string('dt_actual_occurence');
            $table->string('dt_reported');
            $table->string('incident_location');
            $table->string('involved_property');
            $table->longText('property_data');
            $table->foreignId('receiver')->nullable()->constrained('personnels')->onupdate('cascade')->onDelete('set null');
            $table->string('caller_name');
            $table->string('caller_address');
            $table->string('caller_number');
            $table->string('notification_originator');
            $table->foreignId('first_responding_engine')->constrained('trucks')->onUpdate('cascade');
            $table->foreignId('first_responding_leader')->nullable()->constrained('personnels')->onUpdate('cascade')->onDelete('set null');
            $table->string('time_arrival_on_scene');
            $table->string('alarm_status_time');
            $table->string('Time_Fire_out');
            $table->string('property_owner');
            $table->string('property_occupant');
            $table->longText('details');
            $table->longText('findings');
            $table->longText('recommendation');
            $table->longText('photos')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('minimals');
    }
};
