<?php

namespace App\Containers\AppSection\User\UI\API\Tests\Functional;

use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tests\ApiTestCase;

/**
 * Class GetAllUsersTest.
 *
 * @group user
 * @group api
 */
class GetAllUsersTest extends ApiTestCase
{
    protected string $endpoint = 'get@v1/users';

    protected array $access = [
        'roles' => 'admin',
        'permissions' => 'list-users',
    ];

    public function testSearchUsersByName(): void
    {
        User::factory()->count(3)->create();
        $user = $this->getTestingUser([
            'name' => 'mahmoudzzz'
        ]);

        $response = $this->endpoint($this->endpoint . '?search=name:mahmoudzzz')->makeCall();

        $response->assertStatus(200);
        $responseContent = $this->getResponseContentObject();
        self::assertEquals($user->name, $responseContent->data[0]->name);
        self::assertCount(1, $responseContent->data);
    }
}
