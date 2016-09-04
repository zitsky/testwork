<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExtendsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("users",function(Blueprint $table){
            $table->timestamp("birthday")->nullable();
            $table->string("last_name",64)->nullable();
            $table->string("name",64)->change();
            $table->renameColumn("name","first_name");
            $table->string("avatar",64)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("users",function(Blueprint $table){
            $table->dropColumn(["avatar","last_name","birthday"]);
            $table->string("first_name",255)->change();
            $table->renameColumn("first_name","name");
        });
    }
}
