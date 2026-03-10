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
    Schema::create('mnt_contacto', function (Blueprint $table) {
        $table->id();
        $table->string('valor', 150);
        $table->unsignedBigInteger('id_tipo_contacto')->nullable();
        $table->unsignedBigInteger('id_paciente');
        $table->boolean('estado')->default(true);
        $table->foreign('id_tipo_contacto')->references('id')->on('ctl_tipo_contacto')->nullOnDelete();
        $table->foreign('id_paciente')->references('id')->on('mnt_paciente')->onDelete('cascade');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mnt_contacto');
    }
};
