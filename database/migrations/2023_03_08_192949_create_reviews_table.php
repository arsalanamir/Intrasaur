<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('project_id')->unsigned()->index()->nullable();
            $table->foreign('project_id')->references('id')->on('org_projects');
            $table->bigInteger('sender_id')->unsigned()->index()->nullable();
            $table->foreign('sender_id')->references('id')->on('users');
            $table->bigInteger('receiver_id')->unsigned()->index()->nullable();
            $table->foreign('receiver_id')->references('id')->on('users');
            $table->integer('rating')->nullable();
            $table->text('heading')->nullable();
            $table->text('description')->nullable();
            $table->text('status')->defult(0);
            $table->text('reject_reason')->defult(0);

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
        Schema::dropIfExists('reviews');
    }
}
