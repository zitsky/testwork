<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("tasks",function(Blueprint $table){
            $table->increments("id");
            $table->string("name",255);
            $table->text("description");
            $table->timestamp("end");
            $table->integer("created_by");
            $table->integer("project_id");
            $table->timestamps();
            $table->softDeletes();

            $table->foreign("created_by")->references("id")->on("users");
            $table->foreign("project_id")->references("id")->on("projects");
        });

        Schema::create("tasks_assigns",function(Blueprint $table){
            $table->increments("id");
            $table->integer("assigned");
            $table->text("comment");
            $table->integer("created_by");
            $table->integer("task_id");
            $table->timestamps();

            $table->foreign("created_by")->references("id")->on("users");
            $table->foreign("assigned")->references("id")->on("users");
            $table->foreign("task_id")->references("id")->on("tasks");
        });

        Schema::create("task_status",function(Blueprint $table){
            $table->increments("id");
            $table->integer("status_id");
            $table->integer("task_id");
            $table->integer("created_by");
            $table->timestamps();

            $table->foreign("status_id")->references("id")->on("statuses");
            $table->foreign("task_id")->references("id")->on("tasks");
            $table->foreign("created_by")->references("id")->on("users");
        });

        Artisan::call( 'db:seed', [
                '--class' => 'SeedTasks',
                '--force' => true ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop("tasks_assigns");
        Schema::drop("task_status");
        Schema::drop("tasks");
    }
}
