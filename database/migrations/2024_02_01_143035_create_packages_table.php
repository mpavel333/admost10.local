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
        Schema::create('packages', function (Blueprint $table) {
                $table->bigIncrements('id');
                
                $table->string('name_ua')->nullable();
                $table->string('name_ru')->nullable();
                $table->string('name_en')->nullable();

                $table->string('short_desc_ua')->nullable();
                $table->string('short_desc_ru')->nullable();
                $table->string('short_desc_en')->nullable();
                
                $table->longText('full_desc_ua')->nullable();
                $table->longText('full_desc_ru')->nullable();
                $table->longText('full_desc_en')->nullable();
                
                $table->float('price')->default(0)->unsigned()->nullable();
                //$table->float('price_post')->default(0)->unsigned()->nullable()->comment('Стоимость 1 поста');
                
                $table->boolean('published')->default(0)->unsigned()->nullable();
                
                
                $table->boolean('popular')->default(0)->unsigned()->nullable()->comment('Популярен');
                $table->integer('free_days')->default(0)->unsigned()->nullable()->comment('Количество дней бесплатного периода');
                $table->integer('count_channels_post')->default(0)->unsigned()->nullable()->comment('Количество каналов');                                 
                $table->boolean('delayed_posting')->default(0)->unsigned()->nullable()->comment('Отложенный постинг');   
                $table->boolean('buy_and_sell_adv')->default(0)->unsigned()->nullable()->comment('Покупка и продажа рекламы');            
                
                $table->boolean('creat_and_part_collections')->default(0)->unsigned()->nullable()->comment('Создание и участие в подборках');        
                $table->integer('withdrawals')->default(0)->unsigned()->nullable()->comment('Вывод средств N раза в неделю');        
                $table->boolean('analytics')->default(0)->unsigned()->nullable()->comment('Аналитика каналов биржи');        
                $table->boolean('instant_view_blog')->default(0)->unsigned()->nullable()->comment('Блог мгновенного просмотра');        
                $table->integer('count_sellers')->default(0)->unsigned()->nullable()->comment('Наем в N продавцов');        
                $table->boolean('buy_and_sell_channels')->default(0)->unsigned()->nullable()->comment('Покупка и продажа каналов');        
  

/*
первые 30 дней бесплатно

6 каналов

Отложенный постинг

Покупка и продажа рекламы

Создание и участие в подборках

Вывод средств 3 раза в неделю

Аналитика каналов биржи

Блог мгновенного просмотра

Наем в 5 продавцов

Покупка и продажа каналов

*/




                    

                $table->string('slug')->nullable();
                $table->string('alias')->nullable();
                                        
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
