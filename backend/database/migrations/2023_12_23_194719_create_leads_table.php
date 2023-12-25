<?php

use App\Enums\StatusEnum;
use App\Models\Branch;
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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Branch::class)->nullable();
            $table->string('fio');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('message');
            $table->enum('status',StatusEnum::toArray())->default(StatusEnum::new->value);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
