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
        Schema::create('pages', function (Blueprint $table) {
                $table->bigIncrements('id');

                $table->string('name_ua')->nullable();
                $table->string('name_ru')->nullable();
                $table->string('name_en')->nullable();

                $table->longText('full_desc_ua')->nullable();
                $table->longText('full_desc_ru')->nullable();
                $table->longText('full_desc_en')->nullable();
                
                $table->string('image')->nullable();

                $table->boolean('published')->default(0)->unsigned();

                $table->string('slug')->nullable();
                $table->string('alias')->nullable();

                $table->string('meta_title_ua')->nullable();
                $table->string('meta_title_ru')->nullable();
                $table->string('meta_title_en')->nullable();
                
                $table->string('meta_description_ua')->nullable();
                $table->string('meta_description_ru')->nullable();
                $table->string('meta_description_en')->nullable();
                
                $table->string('meta_keywords_ua')->nullable();
                $table->string('meta_keywords_ru')->nullable();
                $table->string('meta_keywords_en')->nullable();

                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
