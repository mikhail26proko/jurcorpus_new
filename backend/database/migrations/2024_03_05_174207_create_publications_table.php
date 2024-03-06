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
        Schema::create('publications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pub_source_id'); // PubSource::class
            $table->foreignId('pub_type_id')->nullable(); // PubType::class
            $table->foreignId('employee_id')->nullable(); // Employee::class
            $table->string('title');
            $table->string('sub_title')->nullable();
            $table->date('publicated_at');
            $table->string('link')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publications');
    }
};
