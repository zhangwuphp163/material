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
        Schema::create('inbound_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('inbound_id')->index();
            $table->unsignedInteger('material_id')->index();
            $table->integer('plan_qty')->default(0);
            $table->integer('actual_qty')->default(0);
            $table->decimal('unit_price',10,2)->default(0);
            $table->timestamp('inbound_at')->index()->nullable();
            $table->timestamp('confirmed_at')->index()->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inbound_items');
    }
};
