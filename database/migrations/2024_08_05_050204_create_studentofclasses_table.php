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
        Schema::create('studentofclasses', function (Blueprint $table) {
            $table->id();

            // Foreign Key
            $table->bigInteger('class_id');
            $table->foreign('class_id')->references('id')->on('classes');

            // Foreign Key
            $table->uuid('student_id');
            $table->foreign('student_id')->references('id')->on('students');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('studentofclasses');
    }
};
