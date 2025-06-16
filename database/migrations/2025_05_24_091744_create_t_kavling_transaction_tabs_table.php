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
            $table->string('order_id');
            $table->string('payment');
            $table->string('name');
            $table->string('email');
            $table->string('upload_ktp');
            $table->string('nomor_ktp');
            $table->string('nomor_kk');
            $table->string('nomor_hp');
            $table->integer('agent_id');
            $table->integer('m_status_id');
            $table->text('catatan');
            $table->text('noted');
            $table->timestamps();
            $table->foreign('t_kavling_tabs_id')->references('id')->on('t_kavling_tabs')->cascadeOnDelete();
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
