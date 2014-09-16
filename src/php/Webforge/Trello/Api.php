<?php

namespace Webforge\Trello;

use GuzzleHttp\Message\RequestInterface as HttpRequest;
use Webforge\Common\JS\JSONConverter;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\GenericEvent as BoardReceivedEvent;

class Api {

  protected $http;

  public function __construct($http, EventDispatcherInterface $dispatcher, Synchronizer $synchronizer) {
    $this->jsonc = new JSONConverter();
    $this->http = $http;
    $this->dispatcher = $dispatcher;
    $this->synchronizer = $synchronizer;
  }

  public function synchronizeMyBoards() {
    $this->requestAndDispatch(
      $this->http->createRequest('GET', 'members/my/boards', array('debug'=>false))
    );
  }

  protected function requestAndDispatch($request, $expect = NULL) {
    $json = $this->send($request);

    foreach ($json as $board) {
      $event = new BoardReceivedEvent($board);
      $event->setName(Events::BOARD_RECEIVED);
      $this->dispatcher->dispatch($event->getName(), $event);
    }

  }

  protected function send(HttpRequest $request) {
    $response = $this->http->send($request);

    return $this->jsonc->parse((string) $response->getBody());
  }

  public function flush() {
    $this->synchronizer->flush();
  }
}
