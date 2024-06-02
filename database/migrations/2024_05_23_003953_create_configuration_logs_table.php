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
        Schema::create('configuration_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId("userID")->nullable()->constrained("users")->onUpdate("cascade")->onDelete("set null");
            $table->longText('Details');
            $table->enum("type", ['occupancy','barangay','alarm', 'truck', 'rank', 'designation', 'personnel', 'passcode']);
            $table->string("action");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configuration_logs');
    }
};
