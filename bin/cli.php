#!/usr/bin/env php
<?php

$bootContainer = require_once __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'bootstrap.php';

$application = $bootContainer->get('projectstack.cli.application');
$application->run();