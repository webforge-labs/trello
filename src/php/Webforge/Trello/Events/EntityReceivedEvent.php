<?php

namespace Webforge\Trello\Events;

class EntityReceivedEvent extends \Symfony\Component\EventDispatcher\GenericEvent {

  protected $entity;

  protected $fqn;

  /**
   * @return string
   */
  public function getFqn() {
    return $this->fqn;
  }
  
  /**
   * @param string fqn
   * @chainable
   */
  public function setFqn($fqn) {
    $this->fqn = $fqn;
    return $this;
  }

  public function setEntity($entity) {
    $this->entity = $entity;
  }

  public function getEntity() {
    return $this->entity;
  }
}
