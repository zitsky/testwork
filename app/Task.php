<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Task extends Model
{
    use SoftDeletes;
    public $hidden=["deleted_at"];
    public $with=["user","status","assigned","project"];
    public $fillable=["name","description","end","created_by","project_id"];

    public function user()
    {
        return $this->belongsTo('App\User',"created_by");
    }

    public function status()
    {
        return $this->belongsToMany('App\Status',"task_status")->orderBy("created_at","DESC");
    }

    public function assigned()
    {
        return $this->hasMany('App\TasksAssign',"task_id")->orderBy("id","DESC")->limit(5);
    }

    public function project()
    {
        return $this->belongsTo('App\Project','project_id');
    }

    public static function OnlyTo(User $user,$project_id=null)
    {
        $q=Task::query();
        $q->leftJoin("tasks_assigns",function($join){
            $join->on("tasks_assigns.id","=",DB::raw("(SELECT ta2.id FROM tasks_assigns as ta2 WHERE ta2.task_id=tasks.id ORDER BY ta2.id DESC LIMIT 1)"));
        });

        $q->where("tasks_assigns.assigned",$user->id);
        if(!is_null($project_id))
            $q->where("tasks.project_id",$project_id);
        $q->selectRaw("tasks.*");
        return $q->get();
    }
}
