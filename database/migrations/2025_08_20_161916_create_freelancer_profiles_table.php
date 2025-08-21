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
        Schema::create('freelancer_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title')->nullable(); // Título profesional
            $table->text('bio')->nullable(); // Biografía
            $table->string('photo')->nullable(); // Foto de perfil
            $table->string('phone')->nullable();
            $table->string('location')->nullable();
            $table->string('website')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('github')->nullable();
            $table->decimal('hourly_rate', 8, 2)->nullable(); // Tarifa por hora
            $table->json('skills')->nullable(); // Habilidades como JSON
            $table->json('services')->nullable(); // Servicios ofrecidos
            $table->boolean('is_available')->default(true); // Disponibilidad
            $table->integer('experience_years')->default(0); // Años de experiencia
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('freelancer_profiles');
    }
};
