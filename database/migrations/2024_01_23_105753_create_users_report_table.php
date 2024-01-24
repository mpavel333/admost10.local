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
        Schema::create('users_report', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->integer('user_id')->nullable()->unsigned();
                $table->text('message')->nullable();
                $table->integer('status')->default(1)->unsigned();               
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_report');
    }
};
