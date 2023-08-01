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
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string('barcode',64)->unique();
            $table->string('name',128)->default("");
            $table->string('description')->default("");
            $table->decimal('price',10,2)->nullable()->default(0);
            $table->decimal('weight',10,3)->nullable()->default(0);
            $table->integer('length')->nullable()->default(0);
            $table->integer('width')->nullable()->default(0);
            $table->integer('height')->nullable()->default(0);
            $table->string('style')->nullable()->default("");
            $table->string('color')->nullable()->default("");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
