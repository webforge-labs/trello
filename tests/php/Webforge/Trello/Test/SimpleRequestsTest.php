<?php

namespace Webforge\Trello\Test;

class SimpleRequestsTest extends \Webforge\Code\Test\Base {
  
  public function setUp() {
    parent::setUp();

    $this->helper = new Helper();
    $this->container = $this->helper->getContainer();

    $this->client = $this->container->get('http.client');
  }

  public function testRequestToAPrivateBoard() {
    $request = $this->client->createRequest('GET', 'boards/9jP4oX7b', array('debug'=>true));
    $response = $this->client->send($request);

    $this->assertThatObject($this->parseJSON((string) $response->getBody()))
      ->debug()
      ->isObject()
        ->property('name', 'tiptoi')->end()
        ->property('id', '5417d8e515e02091bfa0c446')->end()
    ;
  }

}
