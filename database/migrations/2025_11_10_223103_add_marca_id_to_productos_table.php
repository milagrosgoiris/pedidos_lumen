<?php
// database/migrations/xxxx_xx_xx_xxxxxx_add_marca_id_to_productos_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('productos', function (Blueprint $t) {
            $t->foreignId('marca_id')
              ->nullable()
              ->after('nombre')
              ->constrained('marcas')
              ->nullOnDelete();
        });
    }
    public function down(): void {
        Schema::table('productos', function (Blueprint $t) {
            $t->dropForeign(['marca_id']);
            $t->dropColumn('marca_id');
        });
    }
};
