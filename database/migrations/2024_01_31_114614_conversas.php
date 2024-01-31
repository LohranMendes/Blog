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
        Schema::create('conversas', function (Blueprint $table) {
            $table->id('id_chat');
            $table->bigInteger('de_id_usuario')->unsigned();
            $table->bigInteger('para_id_usuario')->unsigned();
            $table->foreign('de_id_usuario')->references('id_usuario')->on('usuarios');
            $table->foreign('para_id_usuario')->references('id_usuario')->on('usuarios');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversas');
    }
};
