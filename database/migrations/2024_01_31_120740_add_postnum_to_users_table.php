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
        Schema::table('users', function (Blueprint $table) {
            $table->integer('postNum')->nullable();
            $table->integer('loveNum')->nullable();
            $table->integer('likeNum')->nullable();
            $table->integer('dislikeNum')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('postNum');
            $table->dropColumn('dislikeNum');
            $table->dropColumn('likeNum');
            $table->dropColumn('loveNum');
        });
    }
};
