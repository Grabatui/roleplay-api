<?php

/**
 * @apiGroup           Game
 * @apiName            getUserWorlds
 * @api                {put} /v1/user/worlds Add authorized user world
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiUse             GeneralSuccessMultipleResponse
 */

use App\Containers\AppSection\Game\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::put('user/worlds', [Controller::class, 'addUserWorld'])
    ->name('api_user_add_user_world')
    ->middleware(['auth:api']);
