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
        Schema::table('posts', function (Blueprint $table) {
            $table->integer('loveNum')->nullable();
            $table->integer('likeNum')->nullable();
            $table->integer('dislikeNum')->nullable();
            $table->integer('commentNum')->nullable();
            $table->integer('shareNum')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('loveNum');
            $table->dropColumn('likeNum');
            $table->dropColumn('dislikeNum');
            $table->dropColumn('commentNum');
            $table->dropColumn('shareNum');
        });
    }
};
