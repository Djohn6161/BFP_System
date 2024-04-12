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
        Schema::create('responses', function (Blueprint $table) {
            $table->id();
            $table->foreign('afor_id');
            $table->foreign('engine_dispatched');
            $table->string('time_dispatched');
            $table->string('time_arrived_at_scene');
            $table->string('response_duration');
            $table->string('time_return_to_base');
            $table->float('water_tank_refilled');
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
