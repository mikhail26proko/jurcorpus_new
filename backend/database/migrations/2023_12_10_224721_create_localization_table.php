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
        Schema::create('localization', function (Blueprint $table) {
            $table->increments('id');
            $table->string('field');
            $table->string('language');
            $table->string('value');
            $table->string('lozalizable_type');
            $table->integer('lozalizable_id');
            $table->timestamps();
          });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('localization');
    }
};
