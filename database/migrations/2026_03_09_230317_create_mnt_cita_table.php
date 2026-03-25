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
    Schema::create('mnt_cita', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('id_paciente');
        $table->unsignedBigInteger('id_doctor');
        $table->unsignedBigInteger('id_estado_cita')->nullable();
        $table->dateTime('fecha_hora');
        $table->integer('duracion_min')->default(30);
        $table->text('motivo')->nullable();
        $table->text('notas')->nullable();
        $table->unsignedBigInteger('id_usuario_creacion')->nullable();
        $table->foreign('id_paciente')->references('id')->on('mnt_paciente')->onDelete('cascade');
        $table->foreign('id_doctor')->references('id')->on('mnt_doctor')->onDelete('cascade');
        $table->foreign('id_estado_cita')->references('id')->on('ctl_estado_cita')->nullOnDelete();
        $table->foreign('id_usuario_creacion')->references('id')->on('users')->nullOnDelete();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mnt_cita');
    }
};
