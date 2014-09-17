<?php

namespace Webforge\Trello\Entities;

use Doctrine\ORM\Mapping AS ORM;
use JMS\Serializer\Annotation AS Serializer;

/**
 * Compiled Entity for Webforge\Trello\Entities\Card
 * 
 * To change table name or entity repository edit the Webforge\Trello\Entities\Card class.
 * @ORM\MappedSuperclass
 */
abstract class CompiledCard {
  
  /**
   * id
   * @ORM\Column
   * @Serializer\Expose
   * @Serializer\Type("string")
   */
  protected $id;
  
  /**
   * board
   * @ORM\ManyToOne(targetEntity="Webforge\Trello\Entities\Board", inversedBy="cards")
   * @ORM\JoinColumn(nullable=false)
   * @Serializer\Expose
   * @Serializer\Type("Webforge\Trello\Entities\Board")
   */
  protected $board;
  
  /**
   * name
   * @ORM\Column
   * @Serializer\Expose
   * @Serializer\Type("string")
   */
  protected $name;
  
  /**
   * closed
   * @ORM\Column(type="boolean")
   * @Serializer\Expose
   * @Serializer\Type("boolean")
   */
  protected $closed;
  
  /**
   * url
   * @ORM\Column
   * @Serializer\Expose
   * @Serializer\Type("string")
   */
  protected $url;
  
  /**
   * dateLastActivity
   * @ORM\Column
   * @Serializer\Expose
   * @Serializer\Type("string")
   */
  protected $dateLastActivity;
  
  /**
   * description
   * @ORM\Column(type="text", nullable=true)
   * @Serializer\Expose
   * @Serializer\Type("string")
   */
  protected $description;
  
  /**
   * descriptionData
   * @ORM\Column(nullable=true)
   * @Serializer\Expose
   * @Serializer\Type("string")
   */
  protected $descriptionData;
  
  /**
   * email
   * @ORM\Column(nullable=true)
   * @Serializer\Expose
   * @Serializer\Type("string")
   */
  protected $email;
  
  /**
   * pos
   * @ORM\Column(type="integer")
   * @Serializer\Expose
   * @Serializer\Type("integer")
   */
  protected $pos;
  
  /**
   * shortLink
   * @ORM\Column(nullable=true)
   * @Serializer\Expose
   * @Serializer\Type("string")
   */
  protected $shortLink;
  
  /**
   * shortUrl
   * @ORM\Column(nullable=true)
   * @Serializer\Expose
   * @Serializer\Type("string")
   */
  protected $shortUrl;
  
  /**
   * due
   * @ORM\Column(nullable=true)
   * @Serializer\Expose
   * @Serializer\Type("string")
   */
  protected $due;
  
  /**
   * labels
   * @ORM\Column(type="array")
   * @Serializer\Expose
   */
  protected $labels;
  
  /**
   * subscribed
   * @ORM\Column(type="boolean")
   * @Serializer\Expose
   * @Serializer\Type("boolean")
   */
  protected $subscribed;
  
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
   * @param Webforge\Trello\Entities\Board $board
   */
  public function setBoard(Board $board) {
    if (isset($this->board) && $this->board !== $board) {
        $this->board->removeCard($this);
    }
    $this->board = $board;
    $board->addCard($this);
    return $this;
  }
  
  /**
   * @return Webforge\Trello\Entities\Board
   */
  public function getBoard() {
    return $this->board;
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
   * @param string $dateLastActivity
   */
  public function setDateLastActivity($dateLastActivity) {
    $this->dateLastActivity = $dateLastActivity;
    return $this;
  }
  
  /**
   * @return string
   */
  public function getDateLastActivity() {
    return $this->dateLastActivity;
  }
  
  /**
   * @param string $description
   */
  public function setDescription($description = NULL) {
    $this->description = $description;
    return $this;
  }
  
  /**
   * @return string
   */
  public function getDescription() {
    return $this->description;
  }
  
  /**
   * @param string $descriptionData
   */
  public function setDescriptionData($descriptionData = NULL) {
    $this->descriptionData = $descriptionData;
    return $this;
  }
  
  /**
   * @return string
   */
  public function getDescriptionData() {
    return $this->descriptionData;
  }
  
  /**
   * @param string $email
   */
  public function setEmail($email = NULL) {
    $this->email = $email;
    return $this;
  }
  
  /**
   * @return string
   */
  public function getEmail() {
    return $this->email;
  }
  
  /**
   * @param integer $pos
   */
  public function setPos($pos) {
    $this->pos = $pos;
    return $this;
  }
  
  /**
   * @return integer
   */
  public function getPos() {
    return $this->pos;
  }
  
  /**
   * @param string $shortLink
   */
  public function setShortLink($shortLink = NULL) {
    $this->shortLink = $shortLink;
    return $this;
  }
  
  /**
   * @return string
   */
  public function getShortLink() {
    return $this->shortLink;
  }
  
  /**
   * @param string $shortUrl
   */
  public function setShortUrl($shortUrl = NULL) {
    $this->shortUrl = $shortUrl;
    return $this;
  }
  
  /**
   * @return string
   */
  public function getShortUrl() {
    return $this->shortUrl;
  }
  
  /**
   * @param string $due
   */
  public function setDue($due = NULL) {
    $this->due = $due;
    return $this;
  }
  
  /**
   * @return string
   */
  public function getDue() {
    return $this->due;
  }
  
  /**
   * @param array $labels
   */
  public function setLabels(Array $labels) {
    $this->labels = $labels;
    return $this;
  }
  
  /**
   * @return array
   */
  public function getLabels() {
    return $this->labels;
  }
  
  /**
   * @param bool $subscribed
   */
  public function setSubscribed($subscribed) {
    $this->subscribed = $subscribed;
    return $this;
  }
  
  /**
   * @return bool
   */
  public function getSubscribed() {
    return $this->subscribed;
  }
  
  public function __construct() {

  }
}
