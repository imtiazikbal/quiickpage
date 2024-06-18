<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->string('auctionPoint')->nullable();
            $table->string('package')->nullable();
            $table->string('keyFeatures')->nullable();
            $table->string('color')->nullable();
            $table->string('price')->nullable();
            $table->string('image')->nullable();
            $table->string('phone')->nullable();
            $table->longText('description')->nullable();
            $table->foreignId('category_id')->nullable()->constrained()->cascadeOnDelete();
           
            $table->timestamps();
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
