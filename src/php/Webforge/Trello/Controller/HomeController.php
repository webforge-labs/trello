<?php

namespace Webforge\Trello\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Webforge\Common\JS\JSONConverter;
use GuzzleHttp\Subscriber\Log\LogSubscriber;
use GuzzleHttp\Subscriber\Log\Formatter;

class HomeController extends Controller {

  public function indexAction() {
    return $this->render(':trello:api-test.html.mustache', array());
  }

  public function requestAction(Request $request) {
    $jsonc = JSONConverter::create();
    $payload = $jsonc->parse((string) $request->getContent());

    $http = $this->get('http.client');
    

    // Log the full request and response messages using echo() calls.
    $log = '';
    $logger = function($msg) use (&$log) {
      $log .= str_replace(array("\n", "\r"), array("--br--", ''), $msg);
    };
    
    $subscriber = new LogSubscriber($logger, Formatter::DEBUG);
    $http->getEmitter()->attach($subscriber);

    $request = $http->createRequest($payload->method, $payload->url);

    $response = $http->send($request);

    $response = new JsonResponse($jsonc->parse((string) $response->getBody()), 200, array('X-Debug'=>$log));

    return $response;
  }
}
