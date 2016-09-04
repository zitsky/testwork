<?php

use Illuminate\Database\Seeder;

class SeedTasks extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $projects=[
            "first","second","thrid","other"
        ];
        foreach($projects as $projectId=>$project)
        {
            for($i=1;$i<=10;$i++)
            {
                $task=\App\Task::create([
                    "name"=>"Task ".$i." in ".$project." project",
                    "description"=>"Description task ".$i." of ".$project." project",
                    "end"=>date("Y-m-d H:i:s",rand(time(),time()+9000)),
                    "created_by"=>rand(1,4),
                    "project_id"=>$projectId+1
                ]);
                $maxStatus=rand(1,4);
                for($s=1;$s<=$maxStatus;$s++)
                    $task->status()->attach([$s],["created_by"=>rand(1,4)]);
                $changes=rand(1,10);
                $prev=0;
                for($a=0;$a<$changes;$a++)
                {

                    $tas=new \App\TasksAssign();
                    $tas->created_by=rand(1,4);
                    $tas->assigned=rand(1,4);
                    if($prev==$tas->assigned)
                        continue;
                    $prev=$tas->assigned;
                    $tas->task_id=$task->id;
                    $tas->comment="Assigned to ".$tas->assigned;
                    $tas->save();
                }
            }
        }

    }
}
