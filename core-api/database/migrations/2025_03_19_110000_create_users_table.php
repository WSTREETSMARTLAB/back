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
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('location')->nullable();
            $table->string('phone')->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->enum('role', ['admin', 'user'])->default('user');
            $table->boolean('active')->default(false); // true after verification
            $table->timestamp('last_login')->nullable();
            $table->string('avatar')->nullable();
            $table->text('bio')->nullable();
            $table->string('website')->nullable();
            $table->string('telegram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();
            $table->json('settings')->nullable();
            $table->enum('subscription_plan', ['free', 'basic', 'premium'])->default('free'); // free, basic, pro
            $table->timestamp('subscription_expires_at')->nullable();
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
