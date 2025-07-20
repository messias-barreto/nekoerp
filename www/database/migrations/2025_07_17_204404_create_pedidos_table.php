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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->string('valor_pedido');
            $table->string('client_name');
            $table->string('client_email');
            $table->string('cep');
            $table->string('logradouro');
            $table->string('complemento');
            $table->string('bairro');
            $table->string('localidade');
            $table->string('uf');
            $table->string('estado');
            $table->string('regiao');
            $table->enum('status', ['pendente', 'concluido', 'cancelado'])->default('pendente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
