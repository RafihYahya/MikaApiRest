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
        Schema::create('sharedlove', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('firstUser_id');
            $table->foreign('firstUser_id')->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('secondUser_id');
            $table->foreign('secondUser_id')->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->integer('sharedLoveCount')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sharedlove');
    }
};
