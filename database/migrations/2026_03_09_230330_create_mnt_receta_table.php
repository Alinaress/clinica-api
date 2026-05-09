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
    Schema::create('mnt_receta', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('id_cita');
        $table->unsignedBigInteger('id_doctor');
        $table->unsignedBigInteger('id_medicamento');
        $table->string('dosis', 100);
        $table->string('frecuencia', 100);
        $table->string('duracion', 100)->nullable();
        $table->text('indicaciones')->nullable();
        $table->foreign('id_cita')->references('id')->on('mnt_cita')->onDelete('cascade');
        $table->foreign('id_doctor')->references('id')->on('mnt_doctor')->onDelete('cascade');
        $table->foreign('id_medicamento')->references('id')->on('ctl_medicamento')->onDelete('cascade');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mnt_receta');
    }
};
