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
    Schema::create('mnt_notificacion', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('id_usuario');
        $table->unsignedBigInteger('id_cita')->nullable();
        $table->string('titulo', 150);
        $table->text('mensaje');
        $table->enum('tipo', ['cita', 'recordatorio', 'cancelacion', 'general'])->default('general');
        $table->boolean('leida')->default(false);
        $table->boolean('enviada_email')->default(false);
        $table->timestamp('enviada_at')->nullable();
        $table->foreign('id_usuario')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('id_cita')->references('id')->on('mnt_cita')->nullOnDelete();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mnt_notificacion');
    }
};
