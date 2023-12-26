<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrusherInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crusher_invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('partner_id')->constrained();
            $table->string('driver');
            $table->string('subject');
            $table->double('wight');
            $table->double('price');
            $table->double('total_price');
            $table->date('date');
            $table->text('note');
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
        Schema::dropIfExists('crusher_invoices');
    }
}
