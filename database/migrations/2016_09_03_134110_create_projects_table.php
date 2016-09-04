<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("statuses",function(Blueprint $table){
            $table->increments("id");
            $table->string("name",64);
            $table->timestamps();
        });

        Schema::create("projects",function(Blueprint $table){
            $table->increments("id");
            $table->string("name",255);
            $table->timestamp("complete_time");
            $table->integer("created_by");
            $table->text("description");
            $table->timestamps();
            $table->foreign("created_by")->references("id")->on("users");
            $table->softDeletes();
        });

        Schema::create("project_status",function(Blueprint $table){
            $table->increments("id");
            $table->integer("status_id");
            $table->integer("project_id");
            $table->integer("created_by");
            $table->timestamps();
            $table->foreign("status_id")->references("id")->on("statuses");
            $table->foreign("project_id")->references("id")->on("projects");
            $table->foreign("created_by")->references("id")->on("users");
        });

        Artisan::call( 'db:seed', [
                '--class' => 'SeedStatusesTable',
                '--force' => true ]
        );

        Artisan::call( 'db:seed', [
                '--class' => 'SeedProjects',
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
        Schema::drop("project_status");
        Schema::drop("projects");
        Schema::drop("statuses");
    }
}
