<?php

namespace App\Http\Controllers;

use App\Http\Core\interfaces\WithUser;
use App\Http\Utils\ResponseUtil;
use Illuminate\Support\Facades\Auth;

class ApiBaseController extends Controller implements WithUser
{
    public function makeResponse($code, $success, Array $other)
    {
        return ResponseUtil::makeResponse($code, $success, $other);
    }

    public function successResponse(Array $other)
    {
        return ResponseUtil::makeResponse(200, true, $other);
    }

    public function failedResponse(Array $other)
    {
        return ResponseUtil::makeResponse(200, true, $other);
    }

    public function getCurrentUser()
    {
        return request()->user;
    }

    public function getCurrentUserId()
    {
        return  Auth::id();
    }


}
