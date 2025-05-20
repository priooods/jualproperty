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
        Schema::create('t_kavling_tabs', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('m_status_tabs_id');
            $table->unsignedInteger('m_type_kavling_tabs_id');
            $table->string('title');
            $table->integer('size');
            $table->string('price');
            $table->string('address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_kavling_tabs');
    }
};
