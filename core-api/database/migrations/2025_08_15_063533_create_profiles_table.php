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
        Schema::create('profiles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('email');
            $table->string('password');
            $table->string('email_verification_code')->nullable();
            $table->timestamp('email_verification_code_expires_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('active')->default(false); // true after verification
            $table->timestamp('last_login')->nullable();
            $table->morphs('owner');
            $table->foreignId('guest_id')
                ->nullable()
                ->constrained('profiles');

            $table->timestamps();
            $table->softDeletes();

            $table->unique(['email', 'owner_id', 'owner_type']);
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
