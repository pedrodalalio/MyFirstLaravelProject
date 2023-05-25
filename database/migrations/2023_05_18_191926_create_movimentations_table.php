<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimentationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimentations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_product');
            $table->unsignedBigInteger('id_batch');
            $table->enum('type', ['entry', 'output']);
            $table->enum('origin', ['none', 'unifae', 'prefeitura']);
            /*
             * 0 = nulo (apenas para saída)
             * 1 = unifae (apenas para entrada)
             * 2 = prefeitura (apenas para entrada)
             */
            $table->integer('qt_product');
            $table->date('dt_movimentation');
            $table->timestamps();

            $table->foreign('id_product')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('id_batch')->references('id')->on('batches')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movimentations');
    }
}
