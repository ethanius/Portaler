<?php

require 'Slim/Slim.php';
require 'htmlmimemail5/htmlMimeMail5.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

$app->post(
    '/core/register',
    function () {
        global $app;
        $app->response->headers->set('Content-Type', 'application/json');

        $rec = new stdClass();
        $app->response->setBody(json_encode($rec));
    }
);

$app->post(
    '/core/login',
    function () {
        global $app;
        $app->response->headers->set('Content-Type', 'application/json');

        $rec = new stdClass();
        $app->response->setBody(json_encode($rec));
    }
);

$app->post(
    '/core/logout',
    function () {
        global $app;
        $app->response->headers->set('Content-Type', 'application/json');

        $rec = new stdClass();
        $app->response->setBody(json_encode($rec));
    }
);

require 'modules/users.php';
require 'modules/messages.php';
require 'modules/board.php';

$app->run();
