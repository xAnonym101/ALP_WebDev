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

            $table->id('product_id');
            $table->string('product_name');
            $table->string('description');
            $table->string('best_seller')->nullable();
            $table->integer('price');
            $table->string('discount_percent')->nullable();
            $table->string('final_price')->nullable();
            $table->string('link')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')
                ->references('category_id')
                ->on('categories')
                ->onDelete('cascade');
            $table->unsignedBigInteger('event_id')->nullable();
            $table->foreign('event_id')
                ->references('event_id')
                ->on('events')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
