<?php

namespace Webforge\Trello\Entities;

use Doctrine\ORM\Mapping AS ORM;
use JMS\Serializer\Annotation AS Serializer;

/**
 * Compiled Entity for Webforge\Trello\Entities\Board
 * 
 * To change table name or entity repository edit the Webforge\Trello\Entities\Board class.
 * @ORM\MappedSuperclass
 */
abstract class CompiledBoard {
  
  /**
   * id
   * @ORM\Column
   * @Serializer\Expose
   * @Serializer\Type("string")
   */
  protected $id;
  
  /**
   * name
   * @ORM\Column
   * @Serializer\Expose
   * @Serializer\Type("string")
   */
  protected $name;
  
  /**
   * desc
   * @ORM\Column(nullable=true)
   * @Serializer\Expose
   * @Serializer\Type("string")
   */
  protected $desc;
  
  /**
   * descData
   * @ORM\Column(nullable=true)
   * @Serializer\Expose
   * @Serializer\Type("string")
   */
  protected $descData;
  
  /**
   * closed
   * @ORM\Column(type="boolean")
   * @Serializer\Expose
   * @Serializer\Type("boolean")
   */
  protected $closed;
  
  /**
   * idOrganization
   * @ORM\Column(nullable=true)
   * @Serializer\Expose
   * @Serializer\Type("string")
   */
  protected $idOrganization;
  
  /**
   * pinned
   * @ORM\Column(type="boolean")
   * @Serializer\Expose
   * @Serializer\Type("boolean")
   */
  protected $pinned;
  
  /**
   * url
   * @ORM\Column
   * @Serializer\Expose
   * @Serializer\Type("string")
   */
  protected $url;
  
  /**
   * shortUrl
   * @ORM\Column
   * @Serializer\Expose
   * @Serializer\Type("string")
   */
  protected $shortUrl;
  
  /**
   * @param string $id
   */
  public function setId($id) {
    $this->id = $id;
    return $this;
  }
  
  /**
   * @return string
   */
  public function getId() {
    return $this->id;
  }
  
  /**
   * @param string $name
   */
  public function setName($name) {
    $this->name = $name;
    return $this;
  }
  
  /**
   * @return string
   */
  public function getName() {
    return $this->name;
  }
  
  /**
   * @param string $desc
   */
  public function setDesc($desc = NULL) {
    $this->desc = $desc;
    return $this;
  }
  
  /**
   * @return string
   */
  public function getDesc() {
    return $this->desc;
  }
  
  /**
   * @param string $descData
   */
  public function setDescData($descData = NULL) {
    $this->descData = $descData;
    return $this;
  }
  
  /**
   * @return string
   */
  public function getDescData() {
    return $this->descData;
  }
  
  /**
   * @param bool $closed
   */
  public function setClosed($closed) {
    $this->closed = $closed;
    return $this;
  }
  
  /**
   * @return bool
   */
  public function getClosed() {
    return $this->closed;
  }
  
  /**
   * @param string $idOrganization
   */
  public function setIdOrganization($idOrganization = NULL) {
    $this->idOrganization = $idOrganization;
    return $this;
  }
  
  /**
   * @return string
   */
  public function getIdOrganization() {
    return $this->idOrganization;
  }
  
  /**
   * @param bool $pinned
   */
  public function setPinned($pinned) {
    $this->pinned = $pinned;
    return $this;
  }
  
  /**
   * @return bool
   */
  public function getPinned() {
    return $this->pinned;
  }
  
  /**
   * @param string $url
   */
  public function setUrl($url) {
    $this->url = $url;
    return $this;
  }
  
  /**
   * @return string
   */
  public function getUrl() {
    return $this->url;
  }
  
  /**
   * @param string $shortUrl
   */
  public function setShortUrl($shortUrl) {
    $this->shortUrl = $shortUrl;
    return $this;
  }
  
  /**
   * @return string
   */
  public function getShortUrl() {
    return $this->shortUrl;
  }
  
  public function __construct() {

  }
}