<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MoneyBoxTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('money_box', function (Blueprint $table) {
            $table->id();
            $table->dateTime('creation_date')->default(now('Europe/Madrid'));
            $table->BigInteger('money')->default(0);
            $table->BigInteger('remove_to_box')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('money_box');
    }
}
