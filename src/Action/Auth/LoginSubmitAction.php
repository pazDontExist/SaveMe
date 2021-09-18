<?php

namespace App\Action\Auth;

use Odan\Session\SessionInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;
use App\Domain\Auth\UserAuth;

/**
 * Class LoginSubmitAction
 * @package App\Action\Auth
 */
final class LoginSubmitAction
{
    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var UserAuth
     */
    private UserAuth $userAuth;

    /**
     * LoginSubmitAction constructor.
     * @param SessionInterface $session Sessiona Management
     * @param UserAuth $userAuth User Authentication
     */
    public function __construct(SessionInterface $session, UserAuth $userAuth)
    {
        $this->session = $session;
        $this->userAuth = $userAuth;
    }

    /**
     * @param ServerRequestInterface $request Request
     * @param ResponseInterface $response Response
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $data = (array)$request->getParsedBody();
        $username = (string)($data['username'] ?? '');
        $password = (string)($data['password'] ?? '');
// Pseudo example
// Check user credentials. You may use an application/domain service and the database here. $user = null;
        $userData = $this->userAuth->authenticate($username, $password);
        // Clear all flash messages
        $flash = $this->session->getFlash();
        $flash->clear();
        // Get RouteParser from request to generate the urls
        $routeParser = RouteContext::fromRequest($request)->getRouteParser();

        if ($userData) {
        // Login successfully
        // Clears all session data and regenerate session ID
            $this->session->destroy();
            $this->session->start();
            $this->session->regenerateId();
            $this->session->set('user', $userData['uid']);
            $this->session->set('role', $userData['role']);
            $this->session->set('fname', $userData['fname']);
            $this->session->set('lname', $userData['lname']);
            $this->session->set('locale', $userData['locale']);
            $this->session->set('email', $userData['email']);
            $flash->add('success', 'Login successfully');

            set_language($userData['locale']);

            // Redirect to protected page
            $response = $response->withHeader('Content-Type', 'application/json');
            $response->getBody()->write((string)json_encode(['status'=>'success', 'user_data'=>$userData], JSON_THROW_ON_ERROR));
            return $response->withStatus(200);
        } else {
            $flash->add('error', 'Login failed!');
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(401, json_encode(['status'=>'error']));
        }
    }
}
