<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id(); // Chave primária (ID auto-incrementado)
            $table->string('name', 100); // Nome do membro
            $table->string('email', 100)->unique(); // E-mail único do membro
            $table->char('cpf', 11)->unique(); // CPF único (11 dígitos)
            $table->char('phone', 11); // Telefone (11 dígitos)
            $table->date('date_of_birth')->nullable(); // Data de nascimento (opcional)
            $table->enum('gender', ['male', 'female', 'other'])->nullable(); // Gênero (opcional)
            $table->timestamps(); // Cria as colunas created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}

