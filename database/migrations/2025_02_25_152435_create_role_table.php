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
        Schema::create('role', function (Blueprint $table) {
            $table->id('role_id');
            $table->string('role_name', 45)->nullable();
            $table->string('active', 1)->nullable();
            $table->string('post_by', 45)->nullable();
            $table->dateTime('post_date')->nullable();
            $table->string('update_by', 45)->nullable();
            $table->dateTime('update_date')->nullable();
            $table->integer('publish_status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role');
    }
};
