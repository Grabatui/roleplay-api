<?php

namespace App\Containers\AppSection\Game\UI\API\Requests\World;

use App\Containers\AppSection\User\Traits\IsOwnerTrait;
use App\Ship\Parents\Requests\Request;

class GetGamesRequest extends Request
{
    use IsOwnerTrait;

    protected array $access = [
        'permissions' => '',
        'roles' => '',
    ];

    public function rules(): array
    {
        return [];
    }

    public function authorize(): bool
    {
        return $this->check([
            'hasAccess|isOwner',
        ]);
    }
}