<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 13.11.2019
 * Time: 16:57
 */

namespace App\Http\Core\interfaces;


interface WithUser
{
    public function getCurrentUser();

    public function getCurrentUserId();
}