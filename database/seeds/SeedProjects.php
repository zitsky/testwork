<?php

use Illuminate\Database\Seeder;

class SeedProjects extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $project=\App\Project::create(["name"=>"First Project","description"=>"Description first project","complete_time"=>date("Y-M-d H:i:s",time()+90000),"created_by"=>1]);
        $project->status()->attach(1,["created_by"=>1]);
        $project=\App\Project::create(["name"=>"Second Project","description"=>"Description second project","complete_time"=>date("Y-M-d H:i:s",time()+90000),"created_by"=>2]);
        $project->status()->attach(1,["created_by"=>2]);
        $project->status()->attach(2,["created_by"=>1]);
        $project=\App\Project::create(["name"=>"Third Project","description"=>"Description thrid project","complete_time"=>date("Y-M-d H:i:s",time()+90000),"created_by"=>3]);
        $project->status()->attach(1,["created_by"=>3]);
        $project->status()->attach(2,["created_by"=>1]);
        $project->status()->attach(4,["created_by"=>2]);
        $project=\App\Project::create(["name"=>"Other Project","description"=>"Description other project","complete_time"=>date("Y-M-d H:i:s",time()+90000),"created_by"=>4]);
        $project->status()->attach(1,["created_by"=>4]);
        $project->status()->attach(2,["created_by"=>2]);
        $project->status()->attach(4,["created_by"=>3]);
        $project->status()->attach(3,["created_by"=>1]);
    }
}
