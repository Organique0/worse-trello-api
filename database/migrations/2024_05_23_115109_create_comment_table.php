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
        Schema::create('comment', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedInteger('card_id');
            $table->unsignedInteger('user_id');
            $table->string('content');
            $table->timestamps();

            $table->foreign('card_id')->references('id')->on('card');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comment');
    }
};
