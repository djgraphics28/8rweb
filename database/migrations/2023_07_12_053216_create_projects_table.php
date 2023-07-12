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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('project_title');
            $table->string('description');
            $table->string('client_name');
            $table->decimal('project_cost', 16);
            $table->string('model_link')->nullable();
            $table->string('floor_plans')->nullable();
            $table->string('building_permit_number')->nullable();
            $table->string('address_location')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->enum('project_status', ['Pending', 'In Progress', 'Out Going', 'Completed'])->default('Pending');
            $table->boolean('is_active')->default(1);
            $table->unsignedBigInteger('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
