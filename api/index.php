<?php

require 'settings.php';
require 'Slim/Slim.php';
require 'htmlmimemail5/htmlMimeMail5.php';
require 'modules/module.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();
$db = new mysqli(Settings::DB_HOST, Settings::DB_USER, Settings::DB_PASSWORD, Settings::DB_DATABASE);

// core
require 'modules/core.php';
$core = new CoreModule($app, $db);
$app->post('/core/register', array($core, 'register'));
$app->post('/core/login', array($core, 'login'));
$app->post('/core/logout',	array($core, 'logout'));

// users
require 'modules/users.php';
$users = new UsersModule($app, $db);

// messages
require 'modules/messages.php';
$messages = new MessagesModule($app, $db);

// board
require 'modules/board.php';
$board = new BoardModule($app, $db);

$app->run();
