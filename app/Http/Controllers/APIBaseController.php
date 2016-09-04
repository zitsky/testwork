<?php
/**
 * Created by PhpStorm.
 * User: Jonic
 * Date: 03.09.2016
 * Time: 18:31
 */

namespace App\Http\Controllers;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class APIBaseController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function SuccessResponse($items,$length=null)
    {
        $response=(object)["success"=>true];
        $response->length=is_null($length)? (is_array($items) || class_basename($items)=='Collection')?sizeof($items):0:$length;
        if($response->length)
        {
            $response->items=(class_basename($items)=='Collection')?$items->toArray():$items;
        }else{
            $response->item=$items;
            unset($response->length);
        }
        //future here place code for refresh only new data and continue loading without offset provided by continue logic
        return (array)$response;
    }
}