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
        Schema::create('portarias', function (Blueprint $table) {
            $table->id();
            $table->integer('numero')->unsigned();
            $table->unsignedBigInteger('assunto_id');
            $table->unsignedBigInteger('setor_id');
            $table->unsignedBigInteger('usuario_id');
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->enum('status', ['Registrado', 'Excluido']);
            $table->date('data');
            $table->string('processo')->nullable();
            $table->date('data_inicio')->nullable();
            $table->date('data_final')->nullable();
            $table->text('observacoes')->nullable();
            $table->string('destino')->nullable();
            $table->foreign('assunto_id')->references('id')->on('assuntos');
            $table->foreign('setor_id')->references('id')->on('setores');
            $table->foreign('usuario_id')->references('id')->on('users');            
            $table->foreign('deleted_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portarias');
    }
};
