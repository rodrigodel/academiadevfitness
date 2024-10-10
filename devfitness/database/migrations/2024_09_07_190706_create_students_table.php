<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id(); // Chave primária 'id'
            $table->string('name', 50); // Coluna 'name' do tipo VARCHAR(50)
            $table->string('email', 50)->unique(); // Coluna 'email' do tipo VARCHAR(50) e único
            $table->char('cpf', 11); // Coluna 'cpf' do tipo CHAR(11)
            $table->char('phone', 11); // Coluna 'phone' do tipo CHAR(11)
            $table->timestamps(); // Colunas 'created_at' e 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}

