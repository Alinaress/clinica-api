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
    Schema::create('mnt_expediente', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('id_paciente');
        $table->string('numero_expediente', 50)->unique();
        $table->date('fecha_apertura');
        $table->text('antecedentes')->nullable();
        $table->text('observaciones')->nullable();
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
        Schema::dropIfExists('mnt_expediente');
    }
};
