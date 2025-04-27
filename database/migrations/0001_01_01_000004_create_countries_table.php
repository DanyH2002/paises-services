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
            $table->string('president');
            $table->decimal('size', 20, 4);
            $table->integer('population');
            $table->string('flag');
            $table->string('language')->nullable();
            $table->string('currency')->nullable();
            $table->unsignedBigInteger('region_id'); // Se define sin la llave foranea
            $table->foreign('region_id')->references('id')->on('regions');
            $table->unsignedBigInteger('user_id')->nullable();
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
