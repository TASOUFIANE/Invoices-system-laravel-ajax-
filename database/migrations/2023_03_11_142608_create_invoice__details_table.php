<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice__details', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number', 50);
            $table->foreignId('id_Invoice')->constrained('invoices')->onDelete('cascade');
            $table->string('product', 50);
            $table->string('section', 999);
            $table->string('status', 50);
            $table->integer('value_Status');
            $table->date('payment_Date')->nullable();
            $table->text('note')->nullable();
            $table->string('user',300);
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
        Schema::dropIfExists('invoice__details');
    }
}
