<?php

namespace Webforge\Trello;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\Event;
use Doctrine\ORM\EntityManager;
use Webforge\Common\ArrayUtil as A;

class Synchronizer {

  public function __construct(EventDispatcherInterface $dispatcher, EntityManager $em) {
    $this->dispatcher = $dispatcher;
    $this->dispatcher->addListener(Events::BOARD_RECEIVED, array($this, 'receivedEvent'), 0);
    $this->dispatcher->addListener(Events::CARD_RECEIVED, array($this, 'receivedEvent'), 0);
    $this->em = $em;

    $this->objects = array();
  }

  public function receivedEvent(Event $event) {
    $entity = $this->synchronize($event->getFqn(), $event->getSubject(), array('uniques'=>array('id')));
    $event->setEntity($entity);
  }

  protected function synchronize($fqn, $data, $options) {
    $options = (object) $options;

    $hash = NULL;
    if (!($entity = $this->isSynchronized($fqn, $data, $options, $hash))) {
      $entity = $fqn::fromData($data);
      $this->em->persist($entity);

      $this->objects[$hash] = $entity;
    }

    return $entity;
  }

  protected function isSynchronized($fqn, $data, \stdClass $options, &$hash = NULL) {
    $uniqueData = array();
    foreach ($options->uniques as $field) {
      $uniqueData[$field] = $data->$field;
    }

    $hash = $this->hash($fqn, $uniqueData);
    if (array_key_exists($hash, $this->objects)) {
      return $this->objects[$hash];
    }

    $qb = $this->em->getRepository($fqn)
      ->createQueryBuilder('entity')
      ->select('entity');

    foreach ($uniqueData as $field => $value) {
      $qb->andWhere($qb->expr()->eq('entity.'.$field, ':'.$field));
      $qb->setParameter($field, $value);
    }

    return $qb->getQuery()->getOneOrNullResult();
  }

  protected function hash($fqn, $uniqueData) {
    asort($uniqueData);

    return $fqn.'__'.A::implode($uniqueData, ',', function($value, $field) {
      return $field.':'.$value;
    });
  }

  public function flush() {
    $this->em->flush();
  }
}
