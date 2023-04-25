<?php

declare(strict_types=1);

$app->get('/', 'App\Controller\Home:getHelp');
$app->get('/status', 'App\Controller\Home:getStatus');

$app->get('/users', App\Controller\Users\GetAll::class);
$app->post('/users', App\Controller\Users\Create::class);
$app->get('/users/{id}', App\Controller\Users\GetOne::class);
$app->put('/users/{id}', App\Controller\Users\Update::class);
$app->delete('/users/{id}', App\Controller\Users\Delete::class);

$app->get('/messages', App\Controller\Messages\GetAll::class);
$app->post('/messages', App\Controller\Messages\Create::class);
$app->get('/messages/{id}', App\Controller\Messages\GetOne::class);
$app->put('/messages/{id}', App\Controller\Messages\Update::class);
$app->delete('/messages/{id}', App\Controller\Messages\Delete::class);
