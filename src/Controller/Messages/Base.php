<?php

declare(strict_types=1);

namespace App\Controller\Messages;

use App\Service\MessagesService;
use Pimple\Psr11\Container;

abstract class Base
{
    protected Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    protected function getMessagesService(): MessagesService
    {
        return $this->container->get('messages_service');
    }
}
