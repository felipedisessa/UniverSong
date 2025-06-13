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
        Schema::create('songs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('audio_path')->nullable();
            $table->string('audio_url')->nullable();
            $table->string('image')->nullable();

            $table->string('genre')->nullable();             // Estilo musical
            $table->unsignedSmallInteger('bpm')->nullable(); // Batidas por minuto
            $table->string('key')->nullable();               // Tonalidade
            $table->string('mood')->nullable();              // Vibe / Emoção
            $table->string('language', 10)->nullable();      // Idioma
            $table->text('tags')->nullable();                // Tags livres
            $table->boolean('is_public')->default(true);     // Visibilidade

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('songs');
    }
};
