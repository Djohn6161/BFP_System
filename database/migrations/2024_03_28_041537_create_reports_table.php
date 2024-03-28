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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('report_types_id')->constrained('report_types')->onUpdate('cascade');
            $table->foreignId('personnels_id')->constrained('personnels')->onUpdate('cascade');
            $table->foreignId('provinces_id')->constrained('provinces')->onUpdate('cascade');
            $table->foreignId('municipalities_id')->constrained('municipalities')->onUpdate('cascade');
            $table->foreignId('barangays_id')->constrained('barangays')->onUpdate('cascade');
            $table->boolean('deleted_at');
            $table->string('name');
            $table->string('description');
            $table->integer('zone');
            $table->string('street');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
