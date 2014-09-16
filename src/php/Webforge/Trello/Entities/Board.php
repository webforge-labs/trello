<?php

namespace Webforge\Trello\Entities;

use Doctrine\ORM\Mapping AS ORM;
use JMS\Serializer\Annotation AS Serializer;

/**
 * 
 * 
 * this entity was compiled from Webforge\Doctrine\Compiler
 * @ORM\Entity
 * @ORM\Table(name="boards")
 * @Serializer\ExclusionPolicy("all")
 */
class Board extends CompiledBoard {

  /**
   * id
   * @ORM\Id
   * @ORM\Column
   * @Serializer\Expose
   * @Serializer\Type("string")
   */
  protected $id;

  public static function fromData(\stdClass $json) {
    $board = new static();
    foreach (
      array(
        'id' => 'setId',
        'name' => 'setName',
        'desc' => 'setDescription',
        'descData'=> 'setDescriptionData',
        'closed' => 'setClosed',
        'idOrganization' => 'setIdOrganization',
        'pinned' => 'setPinned',
        'url' => 'setUrl',
        'shortUrl' => 'setShortUrl'
      ) as $property => $mapping) {

      $board->$mapping($json->$property);
    }

    return $board;
  }
}
