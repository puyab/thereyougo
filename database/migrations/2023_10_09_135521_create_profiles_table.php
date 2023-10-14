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
            $table->enum('role', ['customer', 'admin'])->nullable()->default('customer');
            $table->string('company')->nullable();
            $table->string('telephone')->nullable();
            $table->string('location')->nullable();
            $table->enum('accommodation_type', ['house', 'apartment', 'room'])->nullable();
            $table->integer('bedrooms')->nullable();
            $table->integer('sleep_rooms')->nullable();
            $table->boolean('high_speed_wifi')->nullable();
            $table->json('features')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('linkedin')->unique();
            $table->foreignIdFor(User::class, 'user_id');
            $table->enum('status', ['not_sent', 'pending', 'approved', 'rejected'])->default('not_sent');
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
