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
        Schema::create('lembrete', function (Blueprint $table) {
            $table->id();
            $table->string('mensagem');
            $table->dateTime('dataHora');
            $table->unsignedBigInteger('medico_id')->nullable();  // Relacionamento com o médico
            $table->unsignedBigInteger('paciente_id')->nullable(); // Relacionamento com o paciente
            $table->timestamps();

            // Chaves estrangeiras
            $table->foreign('medico_id')->references('id')->on('medico')->onDelete('cascade');
            $table->foreign('paciente_id')->references('id')->on('paciente')->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lembrete');
    }
};
