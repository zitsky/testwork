<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Project extends Model
{
    use SoftDeletes;
    public $hidden=["deleted_at"];
    public $with=["user","status"];
    public $fillable=["created_by","name","complete_time","description"];

    public function user()
    {
        return $this->belongsTo('App\User','created_by');
    }

    public function status()
    {
        return $this->belongsToMany('App\Status')->orderBy("created_at","DESC");
    }

    public static function OnlyFor(User $user)
    {
        $q=Project::query();
        $q->leftJoin("tasks",function($join){
            $join->on("tasks.project_id","=","projects.id");
        });

        $q->leftJoin("tasks_assigns",function($join) {
            $join->on("tasks_assigns.id","=",DB::raw("(SELECT ta2.id FROM tasks_assigns as ta2 WHERE ta2.task_id=tasks.id ORDER BY ta2.id DESC LIMIT 1)"));
        });

        $q->where("projects.created_by",$user->id)->orWhere("tasks_assigns.assigned",$user->id);
        $q->groupBy("projects.id");
        $q->selectRaw("projects.*");

        return $q->get();
    }
}
