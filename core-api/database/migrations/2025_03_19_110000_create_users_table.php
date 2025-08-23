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
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('phone')->unique()->nullable();
            $table->string('phone_verification_code', 6)->nullable();
            $table->timestamp('phone_verification_code_expires_at')->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->string('country', 2)->nullable(); // ISO-3166-1 alpha-2
            $table->string('city')->nullable();
            $table->string('language', 2)->nullable();
            $table->json('address')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('gender')->nullable();
            $table->unsignedTinyInteger('experience')->nullable();
            $table->string('avatar', 2048)->nullable();
            $table->text('about')->nullable();
            $table->string('telegram')->nullable();
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
