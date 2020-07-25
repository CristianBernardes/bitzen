<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVeiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('veiculos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable()->comment('Usuário Responsável');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('marca')->comment('Marca do veículo');
            $table->string('modelo')->comment('Modelo do veículo');
            $table->year('ano')->comment('Ano do veículo');
            $table->string('placa')->comment('Placa do veículo');
            $table->string('tipo_veiculo')->comment('Tipo do veículo (Moto, Carro, Caminhão)');
            $table->string('tipo_combustivel')->comment('Tipo de combustível do veículo (Gasolina, Alcool, Diesel)');
            $table->integer('quilometragem')->comment('Quilometragem do veículo');
            $table->string('image')->nullable()->comment('Foto do Veículo');
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
        Schema::dropIfExists('veiculos');
    }
}
