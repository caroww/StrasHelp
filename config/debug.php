<?php

use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

$whoops = new Run();
$whoops->prependHandler(new PrettyPageHandler());
$whoops->register();
