<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('model_has_genders');
    }

    public function down(): void
    {
        Schema::create('model_has_genders', function (Blueprint $table) {
            $table->unsignedBigInteger('gender_id');
            $table->unsignedBigInteger('model_id');
            $table->string('model_type');

            $table->foreign('gender_id')->references('id')->on('genders')->onDelete('cascade');
            $table->primary(['gender_id', 'model_id', 'model_type'], 'model_has_genders_primary');
        });
    }
};
