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
        Schema::create('declared_alarms', function (Blueprint $table) {
            $table->id();
            $table->foreign('afor_id');
            $table->string('alarm_name');
            $table->string('time');
            $table->foreign('ground_commander');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('declared_alarms');
    }
};
