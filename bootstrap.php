<?php

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

$autoLoader = require_once __DIR__.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';

$container = new ContainerBuilder();

if (defined('phpunit')) {
  $parameters = 'parameters-webforge-ci.yml';
  //$container->setParameter('http_endpoint', 'http://localhost:3002/1/');
  $container->setParameter('http_endpoint', 'https://api.trello.com/1/');
} else {
  $parameters = 'parameters.yml';
  $container->setParameter('http_endpoint', 'https://api.trello.com/1/');
}

$loader = new YamlFileLoader($container, new FileLocator(__DIR__.DIRECTORY_SEPARATOR.'etc'.DIRECTORY_SEPARATOR.'symfony'));
$loader->load($parameters);
$loader->load('services.yml');

return $GLOBALS['env']['container'] = $container;