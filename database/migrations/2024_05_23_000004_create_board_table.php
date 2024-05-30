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
        Schema::create('board', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedInteger('workspace_id');
            $table->string('title');
            $table->string('imgThumb');
            $table->string('imgFull');
            $table->string('imgAuthor');
            $table->string('imgSite');
            $table->timestamps();

            $table->foreign('workspace_id')->references('id')->on('workspace');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('board');
    }
};
