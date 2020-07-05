<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionSuiteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Question_suite', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('level', 20);
            $table->text('description')->nullable();
            $table->integer('status');
            $table->dateTime('created', 0);
            $table->string('createdby', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Question_suite');
    }
}
