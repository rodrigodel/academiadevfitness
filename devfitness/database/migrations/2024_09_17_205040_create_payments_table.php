<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id(); // ID autoincrementável
            $table->unsignedBigInteger('member_id'); // Chave estrangeira para 'members'
            $table->date('date'); // Data do pagamento
            $table->string('status'); // Status do pagamento (ex: 'paid', 'pending')
            $table->string('payment_method'); // Método de pagamento (ex: 'credit_card', 'cash')
            $table->timestamps(); // Cria os campos 'created_at' e 'updated_at'

            // Define a chave estrangeira
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
