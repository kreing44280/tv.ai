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
        Schema::create('footage_news', function (Blueprint $table) {
            $table->id();
            $table->string('raw_file_name', 200);
            $table->date('folder_name')->nullable();
            $table->string('mp3_name', 200)->nullable();
            $table->string('mp4_name', 200)->nullable();
            $table->string('status_mp3_convert', 10)->default('pending');
            $table->string('mp3_convert_os', 40)->nullable();
            $table->longText('transcript')->nullable();
            $table->string('status_transcript', 20)->default('pending');
            $table->text('news_title')->nullable();
            $table->text('news_desc')->nullable();
            $table->text('news_tag')->nullable();
            $table->text('news_timestamp')->nullable();
            $table->text('news_title_human')->nullable();
            $table->text('news_desc_human')->nullable();
            $table->text('news_tag_human')->nullable();
            $table->text('news_timestamp_human')->nullable();
            $table->char('is_require_transcribe', 1)->default('1');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('footage_news');
    }
};
