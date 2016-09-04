<?php

namespace App\Http\Controllers;

use App\Project;
use App\Status;
use Illuminate\Http\Request;

use App\Http\Requests;

class APIProjectsController extends APIBaseController
{
    /**
     * @api {get} /api/projects Получения списка достуных проектов
     * @apiName list
     * @apiGroup Projects
     *
     **/
    public function index(Request $request)
    {
        return $this->SuccessResponse(Project::onlyFor($request->user()));
    }

    /**
     * @api {PUT} /api/projects Создание нового проекта
     * @apiName create
     * @apiGroup Projects
     *
     **/
    public function store(Request $request)
    {
        DB::beginTransaction();
        $project=new Project(array_merge($request->all(),["created_by"=>$request->user()->id]));
        $project->save();
        $project->status()->attach($request->get("status_id",Status::first()->id),["created_by"=>$request->user()->id]);
        DB::commit();
        return $this->SuccessResponse($project);
    }

    /**
     * @api {get} /api/projects/:id Получение карточки проекта
     * @apiName get
     * @apiGroup Projects
     *
     **/
    public function show($id)
    {
        $project=Project::find(+$id);
        if(is_null($project))
            abort(404);
        return $this->SuccessResponse($project);
    }

    /**
     * @api {post} /api/projects/:id Обновление проекта
     * @apiName update
     * @apiGroup Projects
     *
     **/
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        $project=Project::find(+$id);
        $project->fill($request->all());
        $project->save();
        if($request->has("status_id"))
        {
            $statuses=$project->status();
            if(!sizeof($statuses) || last($statuses)->id!=$request->get("status_id"))
                $project->status()->attach($request->get("status_id",$request->get("status_id")),["created_by"=>$request->user()->id]);
        }
        DB::commit();
        return $this->SuccessResponse($project);
    }

    /**
     * @api {delete} /api/projects/:id Удаление проекта
     * @apiName remove
     * @apiGroup Projects
     *
     **/
    public function destroy($id)
    {
        $project=Project::find(+$id);
        if(is_null($project))
            abort(404);
        $project->delete();
        return $this->SuccessResponse([]);
    }
}
