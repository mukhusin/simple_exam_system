<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_marked_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('exam_id')->nullable()->constrained('exams')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('question_id')->nullable()->constrained('multiple_choice_questions')->onUpdate('cascade')->onDelete('cascade');
            $table->string('answer');
            $table->string('year_done');
            $table->boolean('isMarked')->default(false);
            $table->boolean('isCorrect')->default(false);
            $table->double('score')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_marked_questions');
    }
};
