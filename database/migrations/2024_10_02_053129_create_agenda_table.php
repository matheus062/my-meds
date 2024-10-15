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
 Schema::create('agenda', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('paciente');
            $table->timestamp('dataConsulta');

            $table->foreign('paciente')->references('id')->on('paciente');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agenda');
    }
};
