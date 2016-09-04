<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class APIProfileController extends APIBaseController
{
     /**
      * @api {get} /api/profile Получение профиля текущего пользователя
      * @apiName get
      * @apiGroup Profile
      *
      **/
    public function index(Request $request)
    {
        return $this->SuccessResponse($request->user());
    }

    /**
     * @api {POST} /api/profile Обновиление профиля текущего пользователя
     * @apiName update
     * @apiGroup Profile
     *
     **/
    public function update(Request $request, $id=null)
    {
        DB::beginTransaction();
        $params=$request->all();
        if(isset($params["password"]) && strlen($params["password"]))
            $params["password"]=Hash::make($params["password"]);
        $request->user()->fill($params)->save();
        DB::commit();
        return $this->SuccessResponse($request->user());
    }

}
