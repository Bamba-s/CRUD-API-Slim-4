<?php

declare(strict_types=1);

$container['users_repository'] = static function (Pimple\Container $container): App\Repository\UsersRepository {
    return new App\Repository\UsersRepository($container['db']);
};

$container['messages_repository'] = static function (Pimple\Container $container): App\Repository\MessagesRepository {
    return new App\Repository\MessagesRepository($container['db']);
};
