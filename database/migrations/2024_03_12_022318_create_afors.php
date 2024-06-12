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
            $table->string('originator');
            $table->string('caller_address');
            $table->string('barangay_name');
            $table->string('zone');
            $table->string('location');
            $table->string('full_location');
            $table->string('blotter_number');
            $table->foreignId('received_by')->nullable()->constrained('personnels')->onupdate('cascade')->onDelete('set null');
            $table->string('td_under_control')->nullable();
            $table->string('td_declared_fireout')->nullable();
            $table->string('sketch_of_fire_operation');
            $table->longText('details');
            $table->longText('problem_encounter');
            $table->longText('observation_recommendation');
            $table->string('alarm_status_arrival');
            $table->string('first_responder');
            $table->string('prepared_by')->nullable();
            $table->string('noted_by')->nullable();
            $table->string('deleted_at')->nullable();
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
