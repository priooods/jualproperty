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
        Schema::create('t_kavling_detail_deskripsi_tabs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('t_kavling_tabs_id');
            $table->string('description');
            $table->foreign('t_kavling_tabs_id')->references('id')->on('t_kavling_tabs')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_kavling_detail_deskripsi_tabs');
    }
};
