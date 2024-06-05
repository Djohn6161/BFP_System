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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['admin','user']);
            $table->enum('privilege', ['configuration_cheif', 'investigation_clerk', 'operation_clerk', 'admin_clerk', 'operation_admin_chief', 'investigation_admin_chief','admin_cheif','chief']);
            $table->string('username')->unique();
            $table->string('password');
            $table->string('picture');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
