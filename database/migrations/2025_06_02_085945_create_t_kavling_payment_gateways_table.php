<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('t_kavling_payment_gateways', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('t_kavling_transaction_tabs_id');
            $table->string('payment');
            $table->tinyInteger('payment_status')->default(0);
            $table->timestamps();
            $table->foreign('t_kavling_transaction_tabs_id')->references('id')->on('t_kavling_transaction_tabs')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_kavling_payment_gateways');
    }
};
