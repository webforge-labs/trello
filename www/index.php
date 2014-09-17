<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Debug\Debug;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Cookie;
use Webforge\Common\String as S;
use Webforge\Common\DateTime\DateTime;

$container = require __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'bootstrap.php';

Debug::enable(); // this has problems with autoloading from different locations

$request = Request::createFromGlobals();

if ($inTests = $request->headers->has('X-Environment-In-Tests')) {
  $container->enableTestEnvironment();
}

$kernel = $container->getKernel();

$response = $kernel->handle($request);
$response->send();

$kernel->terminate($request, $response);