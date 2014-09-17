<?php

namespace Webforge\Trello\Entities;

use Doctrine\ORM\Mapping AS ORM;
use JMS\Serializer\Annotation AS Serializer;

/**
 * 
 * 
 * this entity was compiled from Webforge\Doctrine\Compiler
 * @ORM\Entity
 * @ORM\Table(name="cards")
 * @Serializer\ExclusionPolicy("all")
 */
class Card extends CompiledCard {
  /**
   * id
   * @ORM\Id
   * @ORM\Column
   * @Serializer\Expose
   * @Serializer\Type("string")
   */
  protected $id;

  public static function fromData(\stdClass $json) {
    $card = new static();
    foreach (
      array(
        'id' => 'setId',
        'board' => 'setBoard', // must be an object
        'name' => 'setName',
        'closed' => 'setClosed',
        'url' => 'setUrl',
        'dateLastActivity' => 'setDateLastActivity',
        'desc' => 'setDescription',
        'descData' => 'setDescriptionData',
        'email' => 'setEmail',
        'pos' => 'setPos',
        'shortLink' => 'setShortLink',
        'shortUrl' => 'setShortUrl',
        'due' => 'setDue',
        'labels' => 'setLabels',
        'subscribed' => 'setSubscribed'

      ) as $property => $mapping) {

      $card->$mapping($json->$property);
    }

    return $card;
  }
}
