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
        Schema::create('personnels', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('departments_id')->constrained('departments')->onUpdate('cascade');
            $table->foreignId('ranks_id')->constrained('ranks')->onUpdate('cascade');
            $table->string('account_number');
            $table->integer('item_number')->nullable();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('extension')->nullable();
            $table->string('contact_number')->nullable(); 
            $table->date('date_of_birth')->nullable();
            $table->string('maritam_status')->nullable();
            $table->string('gender');
            $table->string('address');
            $table->string('religion');
            $table->string('tin');
            $table->string('gsis');     
            $table->string('pagibig');
            $table->string('philhealth');
            $table->string('highest_eligibility');
            $table->string('highest_training');
            $table->string('specialized_training');
            $table->date('date_entered_other_government_service')->nullable();
            $table->date('date_entered_fire_service')->nullable();
            $table->string('mode_of_entry');
            $table->date('last_date_promotion')->nullable();
            $table->string('appointment_status');
            $table->string('unit_code');
            $table->string('unit_assignment');
            $table->string('admin_operation_remarks');
            $table->string('picture')->nullable();
            $table->string('files')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personnels');
    }
};
