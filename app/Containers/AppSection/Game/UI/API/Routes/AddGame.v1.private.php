<?php

/**
 * @apiGroup           Game
 * @apiName            addGame
 * @api                {put} /v1/user/games Add authorized user game
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiUse             GeneralSuccessMultipleResponse
 */

use App\Containers\AppSection\Game\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::put('user/games', [Controller::class, 'addGame'])
    ->name('api_user_add_game')
    ->middleware(['auth:api']);
