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
            $table->string('visibility');
            $table->string('prefs_background_url')->nullable();
            $table->string('prefs_background')->nullable();
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
