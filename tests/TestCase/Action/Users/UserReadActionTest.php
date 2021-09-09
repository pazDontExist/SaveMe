<?php
namespace App\Test\TestCase\Action\Users;

use App\Test\Fixture\UserFixture;
use App\Test\Traits\AppTestTrait;
use Fig\Http\Message\StatusCodeInterface;
use PHPUnit\Framework\TestCase;
use Selective\TestTrait\Traits\DatabaseTestTrait;

/**
 * Test.
 *
 * @coversDefaultClass \App\Action\Users\UserReadAction
 */
class UserReadActionTest extends TestCase
{
    use AppTestTrait;
    use DatabaseTestTrait;

    /**
     * Test.
     *
     * @return void
     */
    public function testValidId(): void
    {
        $this->insertFixtures([UserFixture::class]);
        //$data['access_token'] = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpc3MiOiJ3d3cuZXhhbXBsZS5jb20iLCJqdGkiOiI0MmJjZGNiMC0wMmM1LTQxOTUtYTk5Yy1lOTdkM2IwM2E0NTciLCJpYXQiOjE2MjYwMDE0MzMuODQ0MTU0LCJuYmYiOjE2MjYwMDE0MzMuODQ0MTU0LCJleHAiOjE2MjYwMTU4MzMuODQ0MTU0LCJ1aWQiOiIyIiwicm9sZSI6IjEifQ.EYX_tgV2JusXk3GGMNp7qmdSRiNOjomY055Jg0UPtJYeUSr8twJgJk7RoZXJpsdFW5tPK3qoFA8GW0hKOB4u6sJrLTbq-TOkr4FQRzh9X8hMIPNzWzl7xXEDERq_VWF4S_5ZqtGHgr63qrQ7Ojv11abDjF61Bf8WRVEwgfsi_PgYquHyLYi4EiBjYQawp6Fw2AXboh8RwTEceu360qEED0GRAp-miEC495ZLH3NB6pMvrBhIhxA3s835F9Lzb1kDs6HFvA1IsEHNZMzTWUD--zm0Ctu-JUK3p-P0nvHBNpv0sxDMWnopSi08vHJBCo_rMbGMi4Yqiaq_9l3HGOl5cQ';

        $request = $this->createRequest(
            'POST',
            '/login',
            [
                'username' => 'admin@example.com',
                'password' => 'password'
            ]
        );

        $response = $this->app->handle($request);
        $data = $response->getBody();



        $request = $this->createRequest('GET', '/api/user/detail/1')
            ->withHeader('Authorization', 'Bearer ' . $data['access_token']);
        $response = $this->app->handle($request);

        $this->assertSame(StatusCodeInterface::STATUS_OK, $response->getStatusCode());
        $this->assertJsonContentType($response);
        $this->assertJsonData(
            [
                'id' => 2,
                'username' => 'admin',
                'password' => 'password',
                'first_name' => null,
                'last_name' => null,
                'email' => 'admin@example.com',
                'user_role_id' => 1,
                'locale' => 'en_US',
                'enabled' => true,
            ],
            $response
        );
    }

    /**
     * Test.
     *
     * @return void
     */
    public function testInvalidId(): void
    {

        $request = $this->createRequest(
            'POST',
            '/login',
            [
                'username' => 'admin@example.com',
                'password' => 'password'
            ]
        );
        $response = $this->app->handle($request);
        $data = $response->getBody();


        $request = $this->createRequest('GET', '/api/user/detail/99')
            ->withHeader('Authorization', 'Bearer ' . $data['access_token']);
        $response = $this->app->handle($request);

        $this->assertSame(StatusCodeInterface::STATUS_BAD_REQUEST, $response->getStatusCode());
    }
}
