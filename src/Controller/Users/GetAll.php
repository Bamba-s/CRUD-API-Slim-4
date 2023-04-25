<?php

declare(strict_types=1);

namespace App\Controller\Users;

use App\CustomResponse as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class GetAll extends Base
{
    public function __invoke(Request $request, Response $response): Response
    {
        $userss = $this->getUsersService()->getAll();

        return $response->withJson($userss);
    }
}
