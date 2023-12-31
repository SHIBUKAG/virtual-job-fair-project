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
        Schema::create('employers', function (Blueprint $table) {
            $table->id();
            $table->string('companyName');
            $table->string('industry');
            $table->string('location');
            $table->string('contactName');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('token');
            $table->string('phone');
            $table->string('website');
            $table->string('verified')->default('false');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employers');
    }
};
