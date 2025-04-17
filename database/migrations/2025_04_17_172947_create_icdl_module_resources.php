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
        Schema::create('icdl_module_resources', function (Blueprint $table) {
            $table->id();
            $table->foreignId('icdl_module_id')->nullable()->references('id')->on('icdl_modules');
            $table->string('resource_name')->nullable();
            $table->string('file_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('icdl_module_resources');
    }
};
