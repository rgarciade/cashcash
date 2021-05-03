<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company_id')->nullable(false)->unsigned();
            $table->string('email', 45)->nullable(true);
            $table->string('name', 45)->nullable(true);
            $table->string('location', 45)->nullable(true);
            $table->string('telephone', 45)->nullable(true);
            $table->bigInteger('facturacion')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
