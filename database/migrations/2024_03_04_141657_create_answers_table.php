<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersTable extends Migration
{
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('post_id')->nullable()->constrained();
            $table->foreignId('question_id')->constrained('questions')->onDelete('cascade');
            $table->text('content');
        });
    }

    public function down()
    {
        Schema::dropIfExists('answers');
    }
};
