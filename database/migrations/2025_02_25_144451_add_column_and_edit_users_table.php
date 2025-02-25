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
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('id', 'user_id');
            $table->renameColumn('name', 'user_name');
            $table->string('firstname', 50)->nullable();
            $table->string('lastname', 50)->nullable();
            $table->string('prefix', 50)->nullable();
            $table->date('birthday')->nullable();
            $table->boolean('active')->default(1);
            $table->string('post_by', 50)->nullable();
            $table->dateTime('post_date')->nullable();
            $table->string('update_by', 50)->nullable();
            $table->dateTime('update_date')->nullable();
            $table->dateTime('publish_date')->nullable();
            $table->integer('publish_status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('user_id', 'id');
            $table->renameColumn('user_name', 'name');
            $table->dropColumn('firstname');
            $table->dropColumn('lastname');
            $table->dropColumn('prefix');
            $table->dropColumn('birthday');
            $table->dropColumn('active');
            $table->dropColumn('post_by');            
            $table->dropColumn('post_date');
            $table->dropColumn('update_by');
            $table->dropColumn('update_date');
            $table->dropColumn('publish_date');
            $table->dropColumn('publish_status');
        });
    }
};
