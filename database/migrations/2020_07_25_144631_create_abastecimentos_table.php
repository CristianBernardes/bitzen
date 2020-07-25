<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbastecimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abastecimentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable()->comment('Usuário Responsável');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('veiculo_id')->nullable()->comment('Veiculo Abastecido');
            $table->foreign('veiculo_id')->references('id')->on('veiculos')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('km_abastecimento')->comment('KM do abastecimento');
            $table->integer('litros_abastecido')->comment('Quantidade de litros abastecido');
            $table->decimal('valor_pago', 8, 2)->comment('Valor Pago');
            $table->date('data_abastecimento')->comment('Data do Abastecimento');
            $table->date('posto_abastecido')->comment('Posto Abastecido');
            $table->string('tipo_combustivel')->comment('Tipo de combustível abastecido (Gasolina, Alcool, Diesel)');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('abastecimentos');
    }
}
