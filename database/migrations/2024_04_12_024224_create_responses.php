<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('afor_id')->constrained('afors')->onDelete('cascade')->onUpdate('cascade');
            $table->string('engine_dispatched');
            $table->string('time_dispatched');
            $table->string('time_arrived_at_scene');
            $table->string('response_duration');
            $table->string('time_return_to_base');
            $table->string('water_tank_refilled');
            $table->string('gas_consumed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('response');
    }
};
