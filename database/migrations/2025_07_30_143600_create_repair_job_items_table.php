<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('repair_job_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('repair_job_id')
                  ->constrained('repair_jobs')
                  ->onDelete('cascade');

            $table->foreignId('inventory_id')
                  ->nullable()
                  ->constrained('inventories')
                  ->onDelete('set null');

            $table->string('manual_type')->nullable();
            $table->decimal('rate', 10, 2)->nullable();
            $table->integer('amount')->nullable();
            $table->decimal('total', 10, 2)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('repair_job_items');
    }
};
