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
         Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('combination_id');
            $table->string('url');
            $table->string('url_highress');
            $table->timestamps();
            
            $table->foreign('combination_id')->references('id')->on('combinations');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('images');
    }
};
