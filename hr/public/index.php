<?php

session_start();

define('BASE_URL', '/hr/');

require_once '../app/core/App.php';
require_once '../app/core/Controller.php';
require_once '../app/core/Model.php';

$app = new App();
