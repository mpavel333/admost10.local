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
        Schema::table('orders', function (Blueprint $table) {
            
            //$table->float('balance')->after('telegram_id')->default(0);
            
                $table->text('hide_text')->after('message')->nullable();
                
                $table->mediumText('links')->after('hide_text')->nullable();
                $table->mediumText('question')->after('links')->nullable();
                
                $table->integer('type')->after('question')->default(0)->unsigned();
            
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
};
