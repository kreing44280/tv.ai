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
        Schema::table('user_role', function (Blueprint $table) {
            $table->renameColumn('id', 'role_role_id');
            $table->integer('user_user_id')->nullable();
            $table->boolean('active')->default(1);
            $table->string('post_by', 50)->nullable();
            $table->dateTime('post_date')->nullable();
            $table->string('update_by', 50)->nullable();
            $table->dateTime('update_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_role', function (Blueprint $table) {
            $table->renameColumn('role_role_id', 'id');
            $table->dropColumn('user_user_id');
            $table->dropColumn('active');
            $table->dropColumn('post_by');            
            $table->dropColumn('post_date');
            $table->dropColumn('update_by');
            $table->dropColumn('update_date');
            $table->dropColumn('role_number');
            $table->dropColumn('role_name');
        });
    }
};
