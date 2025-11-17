<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('tipo'); // 1=a_proveedor, 2=entre_locales
            $table->foreignId('origen_local_id')->nullable()->constrained('locales')->nullOnDelete();
            $table->foreignId('destino_local_id')->nullable()->constrained('locales')->nullOnDelete();
            $table->foreignId('proveedor_id')->nullable()->constrained('proveedores')->nullOnDelete();
            $table->tinyInteger('estado')->default(0); // 0=borrador,1=solicitado,2=enviado,3=recibido,9=cancelado
            $table->decimal('total_estimado', 14, 2)->nullable();
            $table->foreignId('creado_por')->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('pedidos');
    }
};
