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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('material_id')->index();
            $table->unsignedInteger('inbound_id')->nullable()->index();
            $table->unsignedInteger('inbound_item_id')->nullable()->index();
            $table->unsignedInteger('outbound_id')->index()->nullable();
            $table->unsignedInteger('outbound_item_id')->index()->nullable();
            $table->integer('qty')->default(0);
            $table->decimal('unit_price',10,2)->default(0);
            $table->timestamp('inbound_at')->nullable()->index();
            $table->timestamp('outbound_at')->nullable()->index();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
