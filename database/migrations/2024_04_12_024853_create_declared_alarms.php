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
            $table->foreignId('afor_id')->nullable()->constrained('afors')->onupdate('cascade')->onDelete('set null');
            $table->string('alarm_name');
            $table->string('time');
            $table->foreignId('ground_commander')->nullable()->constrained('personnels')->onupdate('cascade')->onDelete('set null');
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
