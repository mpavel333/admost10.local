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
        Schema::table('channels', function (Blueprint $table) {
            
                $table->longtext('tgstat')->after('cpv')->nullable()->comment('данные о канале с api.tgstat.ru');
                $table->dateTime('tgstat_last_update', $precision = 0)->after('tgstat')->nullable();


            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
