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
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('official_name');
            $table->string('president');
            $table->string('capital');
            $table->decimal('size', 20, 4);
            $table->bigInteger('population');
            $table->string('flag');
            $table->unsignedBigInteger('continent_id');
            $table->unsignedBigInteger('language_id');
            $table->unsignedBigInteger('currency_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('continent_id')->references('id')->on('continents');
            $table->foreign('language_id')->references('id')->on('language');
            $table->foreign('currency_id')->references('id')->on('currency');
            $table->foreign('user_id')->references('id')->on('users');
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
