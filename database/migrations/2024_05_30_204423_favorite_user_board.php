<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    protected $table = 'favorite_user_board';
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('favorite_user_board', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('u_id');
            $table->unsignedInteger('b_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
