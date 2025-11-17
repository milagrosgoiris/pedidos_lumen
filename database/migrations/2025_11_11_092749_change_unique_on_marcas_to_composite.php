<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('marcas', function (Blueprint $table) {
            // borra el índice único actual en nombre (ajustá el nombre si es distinto)
            $table->dropUnique('marcas_nombre_unique');

            // crea índice único compuesto: proveedor_id + nombre
            $table->unique(['proveedor_id', 'nombre'], 'marcas_proveedor_nombre_unique');
        });
    }

    public function down(): void
    {
        Schema::table('marcas', function (Blueprint $table) {
            $table->dropUnique('marcas_proveedor_nombre_unique');
            $table->unique('nombre', 'marcas_nombre_unique');
        });
    }
};
