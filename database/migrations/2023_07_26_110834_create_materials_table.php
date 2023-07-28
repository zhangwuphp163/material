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
            $table->string('code',64)->index();
            $table->string('barcode',64)->index();
            $table->string('name',128)->default("");
            $table->string('description',128)->default("");
            $table->decimal('price',10,2)->nullable()->default(0);
            $table->decimal('weight',10,3)->nullable()->default(0);
            $table->decimal('length',10,2)->nullable()->default(0);
            $table->decimal('width',10,2)->nullable()->default(0);
            $table->decimal('height',10,2)->nullable()->default(0);
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
