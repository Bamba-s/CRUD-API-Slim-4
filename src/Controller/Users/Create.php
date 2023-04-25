<?php

declare(strict_types=1);

namespace App\Controller\Users;
use App\Service\UsersService;
use App\CustomResponse as Response;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ServerRequestInterface as Request;

final class Create extends Base
{
    private $userService;

    public function __construct(UsersService $userService)
    {
        $this->userService = $userService;
    }

    public function __invoke(Request $request, Response $response): Response
    {
        $input = (array) $request->getParsedBody();
        $users = $this->getUsersService()->create($input);

        /************************* */
        // Instanciation de UsersService
        $userService = new UsersService();
        // Instanciation de Create en passant $userService comme argument
        $create = new Create($userService);

        // Variables users
        $name = $data['name'];
        $email = $data['email'];
        $password = $data['password'];

        // Appeler la méthode createUser du service pour créer un nouvel utilisateur
        $user = $this->userService->createUser($name, $email, $password);
      /*********************** */
      
        return $response->withJson($users, StatusCodeInterface::STATUS_CREATED);
    }

    
}
