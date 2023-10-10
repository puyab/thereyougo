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
            $table->ulid('id')->primary();
            $table->string('role')->nullable();
            $table->string('company')->nullable();
            $table->string('telephone')->nullable();
            $table->string('location')->nullable();
            $table->string('accommodation_type')->nullable();
            $table->integer('rooms')->nullable();
            $table->integer('sleep_rooms')->nullable();
            $table->boolean('high_speed_wifi')->nullable();
            $table->string('features')->default('[]')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('linkedin')->unique();
            $table->foreignIdFor(User::class, 'user_id');
            $table->enum('status', ['not_sent', 'pending', 'approved', 'rejected'])->default('not_sent');
            $table->uuid('referral_code');
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
