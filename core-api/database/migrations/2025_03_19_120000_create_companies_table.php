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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Название компании
            $table->string('phone')->nullable();
            $table->string('phone_verification_code', 6)->nullable();
            $table->timestamp('phone_verification_code_expires_at')->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->string('legal_name')->nullable(); // Юридическое название
            $table->string('edrpou', 8)->nullable(); // ЄДРПОУ (8 цифр)
            $table->string('inn', 12)->nullable(); // ІНН (10 - 12 цифр)
            $table->string('registration_number')->nullable();  // Номер свидетельства о регистрации
            $table->date('registration_date')->nullable(); // Дата регистрации
            $table->string('country', 2)->nullable(); // ISO-3166-1 alpha-2
            $table->string('city')->nullable();
            $table->json('legal_address')->nullable(); // Юридический адрес
            $table->json('actual_address')->nullable(); // Фактический адрес
            $table->string('business_type')->nullable(); // Тип бизнеса (ФОП, ТОВ, ПАТ)
            $table->string('specialization')->nullable(); // Специализация (растениеводство, животноводство, техника и т.д.)
            $table->unsignedTinyInteger('experience')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_email')->nullable();
            $table->unsignedInteger('employees_count')->nullable();
            $table->string('avatar', 2048)->nullable();
            $table->string('website')->nullable();
            $table->string('telegram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('twitter')->nullable();
            $table->text('about')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
