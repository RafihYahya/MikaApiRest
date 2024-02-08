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
            $table->integer('loveNum')->default(0);
            $table->integer('likeNum')->default(0);
            $table->integer('dislikeNum')->default(0);
            $table->integer('commentNum')->default(0);
            $table->integer('shareNum')->default(0);
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
