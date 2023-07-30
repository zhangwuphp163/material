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
        Schema::create('outbounds', function (Blueprint $table) {
            $table->id();
            $table->string('outbound_number',64)->unique();
            $table->tinyInteger('status')->index()->default(0);
            $table->string('remark')->nullable();
            $table->date('ata_at')->nullable()->index();
            $table->string('time_consuming')->nullable()->index();
            $table->decimal('processing_costs',10,2)->nullable();
            $table->decimal('freight',10,2)->nullable();
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
        Schema::dropIfExists('outbounds');
    }
};
