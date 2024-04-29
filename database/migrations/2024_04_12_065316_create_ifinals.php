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
            $table->foreignId('spot_id')->constrained('spots')->onUpdate('cascade');
            $table->foreignId('investigation_id')->constrained('investigations')->onUpdate('cascade');
            $table->string('place_of_fire');
            $table->string('td_alarm');
            $table->string('establishment_burned');
            $table->float('damage_to_property');
            $table->longText('origin_of_fire');
            $table->longText('cause_of_fire');
            $table->longText('subtantiating_documents');
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
