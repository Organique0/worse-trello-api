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
        Schema::create('card', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedInteger('list_id');
            $table->string('title');
            $table->integer('order');
            $table->string('description')->nullable();
            $table->timestamps();

            $table->foreign('list_id')->references('id')->on('list');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('card');
    }
};
