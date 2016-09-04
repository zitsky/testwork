<?php

namespace App\Http\Controllers;

use App\Status;
use App\Task;
use App\TasksAssign;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class APITasksController extends APIBaseController
{
    /**
     * @api {get} /api/projects/:id/tasks Список задач текущего пользователя в проекте
     * @apiName list
     * @apiGroup Project Tasks
     *
     **/
    /**
     * @api {get} /api/tasks Сисок задач текущего пользователя
     * @apiName list
     * @apiGroup Tasks
     *
     **/
    public function index(Request $request,$project_id=null)
    {
        return $this->SuccessResponse(Task::OnlyTo($request->user(),$project_id));
    }
    /**
     * @api {put} /api/projects/:id/tasks/:id Новая задача в проекте
     * @apiName create
     * @apiGroup Project Tasks
     *
     **/
    /**
     * @api {put} /api/tasks/:id Новая задача
     * @apiName create
     * @apiGroup Tasks
     *
     **/
    public function store(Request $request,$project_id=null)
    {
        DB::beginTransaction();
        $task=new Task(array_merge($request->all(),["created_by"=>$request->user()->id]));
        if($project_id)
            $task->project_id=$project_id;

        $task->save();
        $task->status()->attach($request->get("status_id",Status::first()->id),["created_by"=>$request->user()->id]);

        TasksAssign::AssignUser($request,$task,$request->get("assign_id"),$request->get("comment"));
        $task=Task::find($task->id);
        DB::commit();
        return $this->SuccessResponse($task);
    }
    /**
     * @api {get} /api/projects/:id/tasks/:id Карточка задачи
     * @apiName get
     * @apiGroup Project Tasks
     *
     **/
    /**
     * @api {get} /api/tasks/:id Карточка задачи
     * @apiName get
     * @apiGroup Tasks
     *
     **/
    public function show($project_id,$id=null)
    {
        if(is_null($id))
            $id=$project_id;
        $task=Task::find(+$id);
        if(is_null($task))
            abort(404);
        return $this->SuccessResponse($task);
    }
    /**
     * @api {post} /api/projects/:id/tasks/:id Обновление задачи
     * @apiName update
     * @apiGroup Project Tasks
     *
     **/
    /**
     * @api {post} /api/tasks/:id Обновление задачи
     * @apiName update
     * @apiGroup Tasks
     *
     **/
    public function update(Request $request,$project_id, $id=null)
    {
        if(is_null($id))
            $id=$project_id;

        DB::beginTransaction();
        $task=Task::find(+$id);
        $task->fill($request->all());
        $task->save();

        if($request->has("status_id"))
        {
            $statuses=$task->status();
            if(!sizeof($statuses) || last($statuses)->id!=$request->get("status_id"))
                $task->status()->attach($request->get("status_id"),["created_by"=>$request->user()->id]);
        }

        if($request->has("assign_id") && $request->has("comment") && strlen($request->get("assign_id")) && strlen($request->get("comment")))
        {
            TasksAssign::AssignUser($request,$task,$request->get("assign_id"),$request->get("comment"),["created_by"=>$request->user()->id]);
        }
        DB::commit();
        $task=Task::find(+$id);
        return $this->SuccessResponse($task);
    }
    /**
     * @api {delete} /api/projects/:id/tasks/:id Удаление задачи
     * @apiName remove
     * @apiGroup Project Tasks
     *
     **/
    /**
     * @api {delete} /api/tasks/:id Удаление задачи
     * @apiName remove
     * @apiGroup Tasks
     *
     **/
    public function destroy($project_id, $id=null)
    {
        DB::beginTransaction();
        if(is_null($id))
            $id=$project_id;
        $task=Task::find(+$id);
        if(is_null($task))
            abort(404);

        $task->delete();
        DB::commit();
        return $this->SuccessResponse([]);
    }
}
