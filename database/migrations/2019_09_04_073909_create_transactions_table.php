<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idSender')->unsigned();
            $table->integer('idRecipient')->unsigned();
            $table->integer('ScoreSender');
            $table->integer('ScoreRecipient');
            $table->integer('SendSuma');
            $table->timestamps();
        });
        Schema::table('Transactions', function($table) {
            $table->foreign('idSender')->references('id')->on('Users')->onDelete('cascade');
            $table->foreign('idRecipient')->references('id')->on('Users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
