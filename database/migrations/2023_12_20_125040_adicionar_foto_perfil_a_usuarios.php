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
        Schema::table('usuarios', function (Blueprint $table) {
            $table->string('capa_perfil')->after('senha')->nullable()->default('img/capa-de-perfil.jpg');
            $table->string('foto_perfil')->after('senha')->nullable()->default('img/foto-de-perfil-de-usuario.jpg');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->dropColumn('foto_perfil');
            $table->dropColumn('capa_perfil');
        });
    }
};
