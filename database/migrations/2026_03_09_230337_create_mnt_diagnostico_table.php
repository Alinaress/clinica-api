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
    Schema::create('mnt_diagnostico', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('id_cita');
        $table->unsignedBigInteger('id_expediente');
        $table->unsignedBigInteger('id_tipo_tratamiento')->nullable();
        $table->text('sintomas')->nullable();
        $table->text('descripcion');
        $table->text('observaciones')->nullable();
        $table->foreign('id_cita')->references('id')->on('mnt_cita')->onDelete('cascade');
        $table->foreign('id_expediente')->references('id')->on('mnt_expediente')->onDelete('cascade');
        $table->foreign('id_tipo_tratamiento')->references('id')->on('ctl_tipo_tratamiento')->nullOnDelete();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mnt_diagnostico');
    }
};
