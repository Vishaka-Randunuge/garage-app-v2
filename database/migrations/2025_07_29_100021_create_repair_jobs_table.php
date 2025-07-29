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
        Schema::create('repair_jobs', function (Blueprint $table) {
            $table->id();
            // link to vehicles
            $table->foreignId('vehicle_id')->constrained()->onDelete('cascade');
            // optionally link to inventory part
            $table->foreignId('inventory_id')->nullable()->constrained()->nullOnDelete();
            // or manual entry:
            $table->string('repair_type_manual')->nullable();
            
            $table->decimal('rate', 10, 2)->nullable();
            $table->integer('amount')->nullable();
            $table->decimal('total', 10, 2)->nullable();
        
            // status flag: ongoing vs printed
            $table->enum('status',['ongoing','printed'])->default('ongoing');
            
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repair_jobs');
    }
};
