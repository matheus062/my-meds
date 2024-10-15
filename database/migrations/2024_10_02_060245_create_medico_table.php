<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicoTable extends Migration
{
    public function up()
    {
        Schema::create('medico', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('usuario')->unique();
            $table->string('crm', 254)->unique();
            $table->foreign('usuario')->references('id')->on('users')->onDelete('cascade');
        });


    }

    public function down()
    {
        Schema::dropIfExists('medico');
    }
}
