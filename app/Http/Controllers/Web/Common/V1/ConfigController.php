<?php

namespace App\Http\Controllers\Web\Common\V1;

use App\Http\Controllers\WebBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ConfigController extends WebBaseController
{


    public function migrateRefresh(Request $request)
    {
        if ($request->token == 'kasya') {
            return Artisan::call('migrate:refresh');
        } else {
            return 'fail';
        }
    }

    public function clearAutoLoad(Request $request)
    {
        if ($request->token == 'kasya') {
            return Artisan::call('clear-compiled ') && Artisan::call('php artisan optimize');
        } else {
            return 'fail';
        }
    }

    public function migrate(Request $request)
    {
        if ($request->token == 'kasya') {
            return Artisan::call('migrate');
        } else {
            return 'fail';
        }
    }

    public function keyGenerate(Request $request)
    {
        if ($request->token == 'kasya') {
            return Artisan::call('key:generate');
        } else {
            return 'fail';
        }
    }

    public function configCache(Request $request)
    {
        if ($request->token == 'kasya') {
            return Artisan::call('config:cache');
        } else {
            return 'fail';
        }
    }

    public function dbSeed(Request $request)
    {
        if ($request->token == 'kasya') {
            return Artisan::call('db:seed');
        } else {
            return 'fail';
        }
    }


}
