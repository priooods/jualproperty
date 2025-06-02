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
        Schema::create('t_kavling_transaction_tabs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('t_kavling_tabs_id');
            $table->string('down_payment_paid');
            $table->string('fullname');
            $table->string('ktp_no');
            $table->string('kk_no');
            $table->string('address');
            $table->string('phone');
            $table->string('email');
            $table->string('notes');
            $table->unsignedBigInteger('marketing_users_id');
            $table->string('path_ktp');
            $table->tinyInteger('use_payment_gateway')->default(0);
            $table->unsignedInteger('m_status_tabs_id');
            $table->timestamps();
            $table->foreign('t_kavling_tabs_id')->references('id')->on('t_kavling_tabs')->cascadeOnDelete();
            $table->foreign('marketing_users_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('m_status_tabs_id')->references('id')->on('m_status_tabs')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_kavling_transaction_tabs');
    }
};
