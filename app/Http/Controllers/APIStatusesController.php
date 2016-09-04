<?php

namespace App\Http\Controllers;

use App\Status;
use Illuminate\Http\Request;
use App\Http\Requests;

class APIStatusesController extends APIBaseController
{
    /**
     * @api {get} /api/statuses Список статусов
     * @apiName list
     * @apiGroup Statuses
     *
     **/
    public function index()
    {
        return $this->SuccessResponse(Status::get());
    }

    /**
     * @api {put} /api/statuses Сохраенение нового статуса
     * @apiName create
     * @apiGroup Statuses
     *
     **/
    public function store(Request $request)
    {
        $status=new Status(array_merge($request->all(),["creted_by"=>$request->user()->id]));
        $status->save();
        return $this->SuccessResponse($status);
    }

    /**
     * @api {get} /api/statuses/:id Единичный экземпляр статуса
     * @apiName get
     * @apiGroup Statuses
     *
     **/
    public function show($id)
    {
        $status=Status::find(+$id);
        if(is_null($status))
            abort(404);
        return $this->SuccessResponse($status);
    }

    /**
     * @api {post} /api/statuses/:id Обновление статуса
     * @apiName update
     * @apiGroup Statuses
     *
     **/
    public function update(Request $request, $id)
    {
        $status=Status::find(+$id);
        $status->fill($request->all());
        $status->save();
        return $this->SuccessResponse($status);
    }

    /**
     * @api {delete} /api/statuses/:id Удаление статуса
     * @apiName remove
     * @apiGroup Statuses
     *
     **/
    public function destroy($id)
    {
        $status =Status::find(+$id);
        if(is_null($status))
            abort(404);
        $status->delete();
        return $this->SuccessResponse([]);
    }
}
