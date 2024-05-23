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
        Schema::create('list', function (Blueprint $table) {
            $table->id('listId');
            $table->unsignedInteger('board_id');
            $table->string('title');
            $table->unsignedInteger('order');
            $table->string('description');
            $table->timestamps();

            $table->foreign('board_id')->references('cardId')->on('card');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('list');
    }
};
