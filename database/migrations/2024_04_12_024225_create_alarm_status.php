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
        Schema::create('alarm_status', function (Blueprint $table) {
            $table->id();
            $table->foreignId('afor_id')->constrained('afors')->onUpdate('cascade');
            $table->string('alarm');
            $table->string('time');
            $table->foreignid('ground_commander')->constrained('personnels')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alarm_status');
    }
};
