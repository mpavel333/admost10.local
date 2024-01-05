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
        Schema::create('publications', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->integer('user_id')->nullable()->unsigned();
                $table->string('channels_id')->nullable();
                
                //$table->string('chat_connect')->nullable();
                
                $table->string('name')->nullable();
                $table->text('description')->nullable();
                $table->string('link')->nullable();
                $table->string('image')->nullable();
                $table->text('message')->nullable();
                
                $table->integer('tariff')->nullable(); //->comment('Формат 1/24');
                //$table->integer('price')->nullable()->unsigned();
                $table->integer('status')->default(0)->unsigned();
                
                $table->integer('notifications')->default(0)->unsigned();
                $table->integer('place')->default(0)->unsigned();
                
                
                
                $table->dateTime('published', $precision = 0);
                $table->dateTime('answer', $precision = 0);
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publications');
    }
};
