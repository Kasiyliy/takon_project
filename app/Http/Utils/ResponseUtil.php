<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 13.11.2019
 * Time: 14:50
 */

namespace App\Http\Utils;


class ResponseUtil
{
    public static function makeResponse($code, $success, Array $other)
    {
        $json = array_merge($other, ['success' => $success]);
        return \response()->json($json)->setStatusCode($code);
    }
}