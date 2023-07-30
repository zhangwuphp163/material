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
        Schema::create('inbounds', function (Blueprint $table) {
            $table->id();
            $table->string('inbound_number',64)->unique();
            $table->tinyInteger('status')->index()->default(0);
            $table->string('remark')->nullable();
            $table->date('ata_at')->index()->nullable();
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
        Schema::dropIfExists('inbounds');
    }
};
