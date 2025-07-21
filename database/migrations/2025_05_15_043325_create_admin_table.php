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
        Schema::create('admin', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('email')->unique();
            $table->enum('level', ['1', '2', '3'])->default('2');
            $table->longblob('foto')->nullable();
            $table->string('token')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->rememberToken(); // Sama dengan $table->string('remember_token', 100)->nullable();
            $table->timestamps(); // created_at & updated_at
            $table->string('flag_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin');
    }
};
