<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('role')->nullable();
            $table->string('company')->nullable();
            $table->string('telephone')->nullable();
            $table->string('location')->nullable();
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->enum('accommodation_type', ['house', 'apartment', 'room'])->nullable();
            $table->integer('bedrooms')->nullable();
            $table->integer('sleep_rooms')->nullable();
            $table->boolean('high_speed_wifi')->nullable();
            $table->json('features')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('linkedin')->unique();
            $table->foreignIdFor(User::class, 'user_id');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->string('referral_code');
            $table->string('referred_from')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
