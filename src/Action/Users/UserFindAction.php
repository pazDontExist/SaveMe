<?php

namespace App\Action\Users;


use App\Domain\Users\Service\UserFinder;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action.
 */
final class UserFindAction
{
    private UserFinder $userFinder;

    private Responder $responder;

    /**
     * The constructor.
     *
     * @param UserFinder $userIndex The user index list viewer
     * @param Responder $responder The responder
     */
    public function __construct(UserFinder $userIndex, Responder $responder)
    {
        $this->userFinder = $userIndex;
        $this->responder = $responder;
    }

    /**
     * Action.
     *
     * @param ServerRequestInterface $request The request
     * @param ResponseInterface $response The response
     *
     * @return ResponseInterface The response
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        // Optional: Pass parameters from the request to the findUsers method
        $users = $this->userFinder->findUsers();

        return $this->transform($response, $users);
    }

    /**
     * Transform to json response.
     * This could also be done within a specific Responder class.
     *
     * @param ResponseInterface $response The response
     * @param array $users The users
     *
     * @return ResponseInterface The response
     */
    private function transform(ResponseInterface $response, array $users): ResponseInterface
    {
        $userList = [];

        foreach ($users as $user) {
            $userList[] = [
                'id' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'user_type' => $user->user_type,
                'locale' => $user->locale,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
            ];
        }

        return $this->responder->withJson(
            $response,
            [
                'users' => $userList,
            ]
        );
    }
}
