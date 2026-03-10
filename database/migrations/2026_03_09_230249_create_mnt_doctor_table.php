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
    Schema::create('mnt_doctor', function (Blueprint $table) {
        $table->id();
        $table->string('nombre', 100);
        $table->string('apellido', 100);
        $table->unsignedBigInteger('id_especialidad')->nullable();
        $table->string('num_registro', 50)->nullable()->unique();
        $table->string('foto', 255)->nullable();
        $table->boolean('estado')->default(true);
        $table->unsignedBigInteger('id_usuario')->nullable();
        $table->foreign('id_especialidad')->references('id')->on('ctl_especialidad')->nullOnDelete();
        $table->foreign('id_usuario')->references('id')->on('users')->nullOnDelete();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mnt_doctor');
    }
};
