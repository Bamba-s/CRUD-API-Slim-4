<?php

declare(strict_types=1);

$container['users_service'] = static function (Pimple\Container $container): App\Service\UsersService {
    return new App\Service\UsersService($container['users_repository']);
};

$container['messages_service'] = static function (Pimple\Container $container): App\Service\MessagesService {
    return new App\Service\MessagesService($container['messages_repository']);
};
