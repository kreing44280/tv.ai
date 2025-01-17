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
        Schema::create('footage_transcribe_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('footage_news_id')->nullable();
            $table->string('logs_type', 20)->nullable();
            $table->text('logs')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('footage_transcribe_logs');
    }
};
