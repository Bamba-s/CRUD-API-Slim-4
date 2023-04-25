<?php

declare(strict_types=1);

namespace App\Controller\Users;

use App\CustomResponse as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class GetOne extends Base
{
    /**
     * @param array<string> $args
     */
    public function __invoke(
        Request $request,
        Response $response,
        array $args
    ): Response {
        $users = $this->getUsersService()->getOne((int) $args['id']);

        return $response->withJson($users);
    }
}
