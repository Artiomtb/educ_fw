<?php

use Framework\App;

require_once('../vendor/autoload.php');

$app = new App( include('../config/config.php') );

$app->run();

$app->done();
