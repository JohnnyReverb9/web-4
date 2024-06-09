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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string("user_login")->default("user-" . rand(100000, 999999));
            $table->string("user_name");
            $table->unsignedInteger("user_age")->nullable();
            $table->string("user_email");
            $table->string("user_password");
            $table->text("user_description")->nullable();
            $table->boolean("is_private_account")->default(0);
            $table->unsignedBigInteger("user_total_posts")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
