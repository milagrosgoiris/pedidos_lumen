<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('pedido_comentarios', function (Blueprint $table) {
            if (!Schema::hasColumn('pedido_comentarios', 'pedido_id')) {
                $table->foreignId('pedido_id')->after('id')->constrained('pedidos')->cascadeOnDelete();
            }
            if (!Schema::hasColumn('pedido_comentarios', 'user_id')) {
                $table->foreignId('user_id')->nullable()->after('pedido_id')->constrained('users')->nullOnDelete();
            }
            if (!Schema::hasColumn('pedido_comentarios', 'texto')) {
                $table->text('texto')->after('user_id');
            }
            // Si tu migración anterior creó updated_at y no lo querés, lo podés dropear:
            // if (Schema::hasColumn('pedido_comentarios', 'updated_at')) {
            //     $table->dropColumn('updated_at');
            // }
            // Si no tenés created_at y querés timestamp simple:
            // if (!Schema::hasColumn('pedido_comentarios', 'created_at')) {
            //     $table->timestamp('created_at')->useCurrent();
            // }
        });
    }

    public function down(): void {
        Schema::table('pedido_comentarios', function (Blueprint $table) {
            if (Schema::hasColumn('pedido_comentarios', 'pedido_id')) {
                $table->dropConstrainedForeignId('pedido_id');
            }
            if (Schema::hasColumn('pedido_comentarios', 'user_id')) {
                $table->dropConstrainedForeignId('user_id');
            }
            if (Schema::hasColumn('pedido_comentarios', 'texto')) {
                $table->dropColumn('texto');
            }
            // if (Schema::hasColumn('pedido_comentarios', 'created_at')) {
            //     $table->dropColumn('created_at');
            // }
            // if (!Schema::hasColumn('pedido_comentarios', 'updated_at')) {
            //     $table->timestamps(); // solo si querés revertir al esquema con timestamps
            // }
        });
    }
};
