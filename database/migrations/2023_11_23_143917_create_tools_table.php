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
        Schema::create('tools', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained();

            $table->string('name');
            $table->string('slug')->unique();
            $table->string('photo')->nullable();
            $table->string('website')->nullable();
            $table->string('brief')->nullable();
            $table->longText('description')->nullable();

            $table->string('status');
            $table->string('pricing');

            $table->string('twitter')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('github')->nullable();
            $table->string('support_email')->nullable();

            $table->string('apple_store_link')->nullable();
            $table->string('google_store_link')->nullable();

            $table->dateTime('submitted_at')->nullable();
            $table->dateTime('published_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tools');
    }
};
