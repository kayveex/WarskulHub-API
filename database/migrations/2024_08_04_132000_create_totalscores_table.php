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
        Schema::create('totalscores', function (Blueprint $table) {
            $table->id();

            // Foreign Key to Class Id
            $table->bigInteger('class_id');
            $table->foreign('class_id')->references('id')->on('classes');

            // Foreign key to Student Id
            $table->uuid('student_id');
            $table->foreign('student_id')->references('id')->on('students');

            $table->integer('totalscore');
            $table->text('desc_belajar');
            $table->year('tahunajar_start');
            $table->year('tahunajar_end');
            $table->integer('semester');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('totalscores');
    }
};
