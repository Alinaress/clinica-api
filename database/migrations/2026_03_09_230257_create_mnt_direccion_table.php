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
    Schema::create('mnt_direccion', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('id_paciente');
        $table->string('direccion', 255);
        $table->string('departamento', 100)->nullable();
        $table->string('municipio', 100)->nullable();
        $table->string('referencia', 255)->nullable();
        $table->boolean('estado')->default(true);
        $table->foreign('id_paciente')->references('id')->on('mnt_paciente')->onDelete('cascade');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mnt_direccion');
    }
};
