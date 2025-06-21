<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('middlename');
            $table->string('lastname');
            $table->foreignId('gender_id')->constrained('genders')->onDelete('cascade');
            $table->bigInteger('contactNum');
            $table->string('bdate');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
