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
    Schema::create('role_has_permissions', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('id_rol');
        $table->unsignedBigInteger('id_permission');
        $table->foreign('id_rol')->references('id')->on('roles')->onDelete('cascade');
        $table->foreign('id_permission')->references('id')->on('permissions')->onDelete('cascade');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_has_permissions');
    }
};
