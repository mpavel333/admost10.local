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
            
                $table->integer('subscribers')->after('full_info')->default(0)->unsigned();
                $table->float('er')->after('subscribers')->default(0)->unsigned();
                $table->integer('views')->after('er')->default(0)->unsigned();
                $table->float('cpv')->after('views')->default(0)->unsigned();

            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('channels', function (Blueprint $table) {
            //
        });
    }
};
