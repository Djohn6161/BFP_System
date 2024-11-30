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
            $table->foreignid('investigation_id')->constrained('investigations')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignid('afor_id')->nullable()->constrained('afors')->onUpdate('cascade')->onDelete('set null');
            $table->string('dt_actual_occurence');
            $table->string('dt_reported');
            $table->string('barangay')->nullable();
            $table->string('street')->nullable();
            $table->string('landmark')->nullable();
            $table->string('incident_location');
            $table->string('involved_property');
            $table->longText('property_data');
            $table->foreignId('receiver')->nullable()->constrained('personnels')->onupdate('cascade')->onDelete('set null');
            $table->string('caller_name');
            $table->string('caller_address');
            $table->string('caller_number');
            $table->string('notification_originator');
            $table->foreignId('first_responding_engine')->nullable()->constrained('trucks')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('first_responding_leader')->nullable()->constrained('personnels')->onUpdate('cascade')->onDelete('set null');
            $table->string('time_arrival_on_scene');
            $table->foreignId('alarm_status_time')->nullable()->constrained('alarm_names')->onUpdate('cascade')->onDelete('set null');
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
