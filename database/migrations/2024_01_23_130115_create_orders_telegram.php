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
        Schema::create('orders_telegram', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->integer('order_id')->nullable()->unsigned();
                $table->integer('message_id')->nullable()->unsigned();                
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders_telegram');
    }
};
