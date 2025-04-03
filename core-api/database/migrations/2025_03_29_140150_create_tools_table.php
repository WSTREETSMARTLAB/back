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
        Schema::create('tools', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // todo set enum
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('company_id')->nullable()->constrained()->onDelete('set null');
//            $table->foreignId('room_id')->nullable()->constrained()->onDelete('set null');
            $table->boolean('is_active')->default(false);
            $table->string('code')->unique();
            $table->timestamp('activated_at')->nullable();
            $table->string('name')->nullable();
            $table->string('location_note')->nullable();
            $table->timestamp('last_online_at')->nullable();
            $table->string('firmware_version')->nullable();
            $table->json('meta')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tools');
    }
};
