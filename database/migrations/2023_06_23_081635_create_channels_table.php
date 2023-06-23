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
        Schema::create('tg_channels', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->integer('user_id')->nullable()->unsigned();
                $table->string('link')->nullable();
                $table->string('name')->nullable();
                $table->text('description')->nullable();
                $table->integer('tg_status')->default(0)->unsigned();
                $table->integer('status')->default(0)->unsigned();
                $table->longText('full_info')->nullable();
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('channels');
    }
};
