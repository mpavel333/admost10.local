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
        Schema::create('channels_favorite', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->integer('channel_id')->nullable()->unsigned();
                $table->integer('user_id')->nullable()->unsigned();
                $table->integer('status')->default(0)->unsigned()->comment('1-избранное, 2-черный список');               
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('channels_favorite');
    }
};
