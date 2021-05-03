<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SalesArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_articles', function (Blueprint $table) {

            $table->id();
            $table->bigInteger('sales_id')->default(0)->unsigned();
            $table->dateTime('creation_date')->default(now('Europe/Madrid'));
            $table->bigInteger('articleId')->nullable(false)->unsigned();
            $table->string('description')->default('');
            $table->double('article_price', 10,2)->default(0);
            $table->double('units',10,0)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('saless_articles');
    }
}
