<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\Request;

class TasksAssign extends Model
{
    public $with=["user","assigned"];
    public static function AssignUser(Request $request,Task $task,$user,$comment="")
    {
        if(TasksAssign::where("task_id",$task->id)->where("assigned",+$user)->where("comment",$comment)->count())
            return;
        $taskAssign=new TasksAssign();
        $taskAssign->task_id=$task->id;
        $taskAssign->assigned=+$user;
        $taskAssign->comment=$comment;
        $taskAssign->created_by=$request->user()->id;
        $taskAssign->save();
    }

    public function user()
    {
        return $this->belongsTo('App\User',"created_by");
    }

    public function assigned()
    {
        return $this->belongsTo('App\User',"assigned");
    }
}
