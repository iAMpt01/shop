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
       Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('sku');
            $table->string('name')->nullable();
            $table->text('short_description')->nullable();
            $table->text('long_description')->nullable();
            $table->string('dimensions')->nullable();
            $table->decimal('price')->nullable();
            $table->string('brand')->nullable();
            $table->string('country_of_origin')->nullable();
            $table->string('material')->nullable();
            $table->boolean('printable');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();
            
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('products');
    }
};
