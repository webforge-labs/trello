<?php

namespace Webforge\Trello;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\Event;
use Doctrine\ORM\EntityManager;

class Synchronizer {

  public function __construct(EventDispatcherInterface $dispatcher, EntityManager $em) {
    $this->dispatcher = $dispatcher;
    $this->dispatcher->addListener(Events::BOARD_RECEIVED, array($this, 'receivedBoard'), 0);
    $this->em = $em;
  }

  public function receivedBoard(Event $event) {
    $board = $event->getSubject();

    $this->synchronize('Webforge\Trello\Entities\Board', $board, array('uniques'=>array('id')));
  }

  protected function synchronize($fqn, $data, $options) {
    $options = (object) $options;
    $entity = $fqn::fromData($data);

    $this->em->persist($entity);
  }

  public function flush() {
    $this->em->flush();
  }
}
