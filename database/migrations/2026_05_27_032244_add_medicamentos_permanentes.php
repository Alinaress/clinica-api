<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('mnt_paciente', function (Blueprint $table) {
            $table->text('medicamentos_permanentes')->nullable()->after('alergias');
        });
    }

    public function down(): void
    {
        Schema::table('mnt_paciente', function (Blueprint $table) {
            $table->dropColumn('medicamentos_permanentes');
        });
    }
};
