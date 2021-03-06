<?php

namespace App\Containers\AppSection\User\UI\API\Controllers;

use App\Containers\AppSection\User\Actions\DeleteUserAction;
use App\Containers\AppSection\User\Actions\FindUserByIdAction;
use App\Containers\AppSection\User\Actions\ForgotPasswordAction;
use App\Containers\AppSection\User\Actions\GetAllUsersAction;
use App\Containers\AppSection\User\Actions\GetAuthenticatedUserAction;
use App\Containers\AppSection\User\Actions\RegisterUserAction;
use App\Containers\AppSection\User\Actions\ResetPasswordAction;
use App\Containers\AppSection\User\Actions\UpdateUserAction;
use App\Containers\AppSection\User\Actions\UserSettings\GetUserSettingsAction;
use App\Containers\AppSection\User\Actions\UserSettings\SetUserSettingsAction;
use App\Containers\AppSection\User\UI\API\Requests\DeleteUserRequest;
use App\Containers\AppSection\User\UI\API\Requests\FindUserByIdRequest;
use App\Containers\AppSection\User\UI\API\Requests\ForgotPasswordRequest;
use App\Containers\AppSection\User\UI\API\Requests\GetAllUsersRequest;
use App\Containers\AppSection\User\UI\API\Requests\GetAuthenticatedUserRequest;
use App\Containers\AppSection\User\UI\API\Requests\RegisterUserRequest;
use App\Containers\AppSection\User\UI\API\Requests\ResetPasswordRequest;
use App\Containers\AppSection\User\UI\API\Requests\UpdateUserRequest;
use App\Containers\AppSection\User\UI\API\Requests\UserSettings\GetUserSettingsRequest;
use App\Containers\AppSection\User\UI\API\Requests\UserSettings\SetUserSettingsRequest;
use App\Containers\AppSection\User\UI\API\Transformers\UserPrivateProfileTransformer;
use App\Containers\AppSection\User\UI\API\Transformers\UserSettingTransformer;
use App\Containers\AppSection\User\UI\API\Transformers\UserTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Auth;
use Illuminate\Http\JsonResponse;

class Controller extends ApiController
{
    public function registerUser(RegisterUserRequest $request): array
    {
        $user = app(RegisterUserAction::class)->run($request);
        return $this->transform($user, UserTransformer::class);
    }

    public function updateUser(UpdateUserRequest $request): array
    {
        $user = app(UpdateUserAction::class)->run($request);
        return $this->transform($user, UserTransformer::class);
    }

    public function deleteUser(DeleteUserRequest $request): JsonResponse
    {
        app(DeleteUserAction::class)->run($request);
        return $this->noContent();
    }

    public function getAllUsers(GetAllUsersRequest $request): array
    {
        $users = app(GetAllUsersAction::class)->run();
        return $this->transform($users, UserTransformer::class);
    }

    public function findUserById(FindUserByIdRequest $request): array
    {
        $user = app(FindUserByIdAction::class)->run($request);
        return $this->transform($user, UserTransformer::class);
    }

    public function getAuthenticatedUser(GetAuthenticatedUserRequest $request): array
    {
        $user = app(GetAuthenticatedUserAction::class)->run();
        return $this->transform($user, UserPrivateProfileTransformer::class);
    }

    public function resetPassword(ResetPasswordRequest $request): JsonResponse
    {
        app(ResetPasswordAction::class)->run($request);
        return $this->noContent();
    }

    public function forgotPassword(ForgotPasswordRequest $request): JsonResponse
    {
        app(ForgotPasswordAction::class)->run($request);
        return $this->noContent(202);
    }

    public function getUserSettings(GetUserSettingsRequest $request): array
    {
        $userSettings = app(GetUserSettingsAction::class)->run(Auth::id(), $request);

        return $this->transform($userSettings, UserSettingTransformer::class);
    }

    public function setUserSettings(SetUserSettingsRequest $request): JsonResponse
    {
        app(SetUserSettingsAction::class)->run(Auth::id(), $request);

        return $this->noContent();
    }
}
