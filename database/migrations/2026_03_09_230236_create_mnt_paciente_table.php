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
    Schema::create('mnt_paciente', function (Blueprint $table) {
        $table->id();
        $table->string('nombre', 100);
        $table->string('apellido', 100);
        $table->string('dui', 10)->nullable()->unique();
        $table->unsignedBigInteger('id_genero')->nullable();
        $table->unsignedBigInteger('id_grupo_sanguineo')->nullable();
        $table->date('fecha_nacimiento')->nullable();
        $table->text('alergias')->nullable();
        $table->boolean('estado')->default(true);
        $table->unsignedBigInteger('id_usuario')->nullable();
        $table->foreign('id_genero')->references('id')->on('ctl_genero')->nullOnDelete();
        $table->foreign('id_grupo_sanguineo')->references('id')->on('ctl_grupo_sanguineo')->nullOnDelete();
        $table->foreign('id_usuario')->references('id')->on('users')->nullOnDelete();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mnt_paciente');
    }
};
