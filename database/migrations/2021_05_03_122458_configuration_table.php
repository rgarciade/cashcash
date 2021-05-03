<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ConfigurationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configuration', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('vat')->nullable(false)->unsigned();
            $table->bigInteger('banknumber')->nullable(true)->unsigned();
            $table->string('mail', 40)->nullable(true);
            $table->string('mailpassword', 40)->nullable(true);
            $table->string('mailhost', 40)->nullable(true);
            $table->string('mailport', 40)->nullable(true);
            $table->boolean('secure')->default(0);
            $table->boolean('tls')->default(0);
            $table->binary('mailimg')->nullable(true);
            $table->string('tiketsprinter', 22)->default('');
            $table->string('facturationprinter', 22)->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configuration');
    }
}
