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
        Schema::create('transactions', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('user_id');
            $table->string('ref');
            $table->string('email');
            $table->float('amount');
            $table->string('description');
            $table->string('currency');
            $table->string('transaction');
            $table->string('status');
            $table->string('message');
            $table->string('channel');
            $table->string('referrer');
            $table->string('domain');
            $table->timestamps();
        });
    }
    // 'description', 
    // 'currency',
    //  'transaction', 'status', 'message', 'channel', 'referrer', 'domain'
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
