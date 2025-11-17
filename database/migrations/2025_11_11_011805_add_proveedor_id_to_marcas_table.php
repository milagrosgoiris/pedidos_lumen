<?php
// database/migrations/2025_11_10_000001_add_proveedor_id_to_marcas_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('marcas', function (Blueprint $table) {
            $table->foreignId('proveedor_id')
                ->nullable() // si ya hay marcas sin proveedor; después lo podés volver NOT NULL
                ->constrained('proveedores')
                ->cascadeOnUpdate()
                ->restrictOnDelete(); // evita borrar un proveedor con marcas
        });
    }

    public function down(): void {
        Schema::table('marcas', function (Blueprint $table) {
            $table->dropForeign(['proveedor_id']);
            $table->dropColumn('proveedor_id');
        });
    }
};
