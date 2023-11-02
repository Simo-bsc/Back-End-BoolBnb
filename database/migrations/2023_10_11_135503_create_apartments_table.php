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
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('slug', 255)->unique();
            $table->decimal('price_per_night', 8, 2)->unsigned();
            $table->tinyInteger('rooms_number')->unsigned();
            $table->tinyInteger('beds_number')->unsigned();
            $table->tinyInteger('bathrooms_number')->unsigned();
            $table->smallInteger('square_meters')->unsigned();
            $table->string('address', 255);
            $table->string('latitude', 64);
            $table->string('longitude', 64);
            $table->text('cover_img')->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('visible');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apartments');
    }

};

