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
        Schema::create('label', function (Blueprint $table) {
            $table->id('labelId');
            $table->unsignedInteger('color_id');
            $table->unsignedInteger('card_id');
            $table->string('title');
            $table->timestamps();

            $table->foreign('color_id')->references('colorId')->on('color');
            $table->foreign('card_id')->references('cardId')->on('card');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('label');
    }
};
