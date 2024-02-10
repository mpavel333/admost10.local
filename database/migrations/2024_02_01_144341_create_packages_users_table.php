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
        Schema::create('packages_users', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->integer('user_id')->nullable()->unsigned();
                //$table->integer('package_id')->nullable();
                $table->longText('package')->nullable();
                $table->dateTime('date_start', $precision = 0);
                $table->dateTime('date_end', $precision = 0);
                
                //$table->integer('free_days')->default(0)->unsigned()->nullable()->comment('Количество дней бесплатного периода');
                $table->integer('count_channels_post')->default(0)->unsigned()->nullable()->comment('Количество каналов');  
                $table->integer('withdrawals')->default(0)->unsigned()->nullable()->comment('Вывод средств(кол-во раз) в неделю');   
                $table->integer('count_sellers')->default(0)->unsigned()->nullable()->comment('Наем продавцов');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages_users');
    }
};
