<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->string('slug');
            $table->string('path')->unique();

            $table->text('description')
                ->nullable();

            $table->text('content')
                ->nullable();

            $table->timestamp('created_at');
            $table->unsignedInteger('created_by')
                ->references('id')
                ->on('users');

            $table->timestamp('updated_at')
                ->nullable();
            $table->unsignedInteger('updated_by')
                ->references('id')
                ->on('users')
                ->nullable();

            $table->boolean('active')
                ->default(0);
            $table->timestamp('activated_at')
                ->nullable();
            $table->unsignedInteger('activated_by')
                ->references('id')
                ->on('users')
                ->nullable();

            $table->timestamp('deleted_at')
                ->nullable();
            $table->unsignedInteger('deleted_by')
                ->references('id')
                ->on('users')
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
