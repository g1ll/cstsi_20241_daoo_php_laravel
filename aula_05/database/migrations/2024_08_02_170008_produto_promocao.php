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
        Schema::create('produto_promocao', function (Blueprint $table) {
            $table->foreignId('produto_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('promocao_id')
                ->references('id')->on('promocoes')
                ->cascadeOnDelete();
            $table->primary(['produto_id','promocao_id']);
            $table->integer('desconto')->default(10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promocao_produto');
    }
};


//Para executar uma migration isoladamente use o comando --path
// passe todo caminho (path), desde a pasta raiz da aplicacao
//Comando:
// php artisan migrate --path='database/migrations/2024_08_02_170008_produto_promocao.php'
