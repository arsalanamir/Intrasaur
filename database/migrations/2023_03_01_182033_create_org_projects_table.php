<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrgProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('org_projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->text('overview')->nullable();
            $table->string('app_start_date')->nullable();
            $table->string('app_end_date')->nullable();
            $table->string('project_start_date')->nullable();
            $table->string('Project_end_date')->nullable();
$table->integer('status')->default(1);
            $table->bigInteger('assignee_id')->unsigned()->index()->nullable();
            $table->foreign('assignee_id')->references('id')->on('users');
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
        Schema::dropIfExists('org_projects');
    }
}
