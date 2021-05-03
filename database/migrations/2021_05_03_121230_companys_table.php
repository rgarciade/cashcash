<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CompanysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companys', function (Blueprint $table) {
            $table->id();
            $table->string('cif', 45)->nullable();
            $table->string('name', 45)->nullable();
            $table->string('contact', 45)->nullable();
            $table->string('location', 45)->nullable();
            $table->string('telephone', 45)->nullable();
            $table->string('email', 45)->nullable();
            $table->string('street', 255)->nullable();
            $table->string('city', 45)->nullable();
            $table->string('province', 45)->nullable();
            $table->string('cta', 45)->nullable();
            $table->string('state', 45)->nullable();
            $table->string('postalcode', 45)->nullable();
            $table->string('banck', 45)->nullable();
            $table->string('mobile', 45)->nullable();
            $table->string('notas', 510)->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companys');
    }
}
