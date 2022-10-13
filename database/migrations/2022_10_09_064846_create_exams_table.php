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
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->integer('total_qns')->nullable();
            $table->double('weight_each');
            $table->integer('muda');
            $table->string('start_date')->nullable();
            $table->double('marks')->nullable();
            $table->text('description')->nullable();
            $table->longText('passage')->nullable();
            $table->string('deadline')->nullable();
            $table->boolean('isActive')->default(false);
            $table->string('type')->default('multiple_choice');
            $table->text('link')->nullable();
            $table->foreignId('updated_by')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('set null');
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
        Schema::dropIfExists('exams');
    }
};
