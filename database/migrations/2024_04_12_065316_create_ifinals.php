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
        Schema::create('ifinals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('spot_id')->nullable()->constrained('spots')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('investigation_id')->constrained('investigations')->onUpdate('cascade')->onDelete('cascade');
            $table->string('intelligence_unit');
            $table->string('barangay')->nullable();
            $table->string('street')->nullable();
            $table->string('landmark')->nullable();
            $table->string('place_of_fire')->nullable();
            $table->string('td_alarm');
            $table->string('establishment_burned');
            $table->float('damage_to_property');
            $table->longText('origin_of_fire');
            $table->longText('cause_of_fire');
            $table->longText('substantiating_documents');
            $table->longText('facts_of_the_case');
            $table->longText('discussion');
            $table->longText('findings');
            $table->longText('recommendation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('final');
    }
};
