<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FacturaionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company_id')->nullable(false)->unsigned();
            $table->enum('paymentType',['Transferencia','Recibo','Contado','Tarjeta']);
            $table->dateTime('creation_date')->default(now('Europe/Madrid'));
            $table->double('price', 10,2)->default(0);
            $table->integer('vat')->default(21);
            $table->BigInteger('paid')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facturations');
    }
}
