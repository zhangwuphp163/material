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
        Schema::create('outbound_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('outbound_id')->index();
            $table->unsignedInteger('sku_id')->index();
            $table->integer('order_qty')->default(0)->index();
            $table->integer('actual_qty')->default(0)->index();
            $table->decimal('unit_price',10,2)->default(0);
            $table->decimal('unit_material_costs',10,2)->default(0);
            $table->timestamp('outbound_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outbound_items');
    }
};
