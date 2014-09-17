<?php

namespace Webforge\Trello;

use GuzzleHttp\Message\RequestInterface as HttpRequest;
use Webforge\Common\JS\JSONConverter;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Webforge\Trello\Events\EntityReceivedEvent as BoardReceivedEvent;
use Webforge\Trello\Events\EntityReceivedEvent as CardReceivedEvent;
use Webforge\Trello\Entities\Board;

class Api {

  protected $http;

  public function __construct($http, EventDispatcherInterface $dispatcher, Synchronizer $synchronizer) {
    $this->jsonc = new JSONConverter();
    $this->http = $http;
    $this->dispatcher = $dispatcher;
    $this->synchronizer = $synchronizer;
  }

  public function synchronizeMyBoards() {
    $json = $this->send(
      $this->http->createRequest('GET', 'members/my/boards', array('debug'=>false))
    );

    $boards = array();
    foreach ($json as $board) {
      $event = new BoardReceivedEvent($board);
      $event->setFqn('Webforge\Trello\Entities\Board');
      $event->setName(Events::BOARD_RECEIVED);
      $this->dispatcher->dispatch($event->getName(), $event);
      $boards[] = $event->getEntity();
    }

    return $boards;
  }

  public function synchronizeBoardCards(Board $board) {
    $json = $this->send(
      $this->http->createRequest('GET', 'boards/'.$board->getId().'/cards', array('debug'=>true))
    );

    $cards = array();
    foreach ($json as $card) {
      $card->board = $board;
      $event = new CardReceivedEvent($card);
      $event->setFqn('Webforge\Trello\Entities\Card');
      $event->setName(Events::CARD_RECEIVED);
      $this->dispatcher->dispatch($event->getName(), $event);
      $cards[] = $event->getEntity();
    }

    return $cards;
  }

  protected function send(HttpRequest $request) {
    $response = $this->http->send($request);

    return $this->jsonc->parse((string) $response->getBody());
  }

  public function flush() {
    $this->synchronizer->flush();
  }
}
