<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $table = 'workspace_user_board';
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('workspace_user_board', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('userId');
            $table->unsignedInteger('workspaceId');
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
