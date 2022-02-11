<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTodoItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todo_items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 100);
            $table->string('content')->nullable();
            $table->enum('level', [0, 1, 2])->comment('0:low|1:medium|2:high')->default(0);
            $table->boolean('finish')->default(0);
            $table->boolean('is_top')->default(0);
            $table->string('user_name')->nullable();
            $table->dateTime('deadline');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_name')->references('name')->on('users')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('todo_items');
    }
}
