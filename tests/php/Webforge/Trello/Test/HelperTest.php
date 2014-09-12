<?php

namespace Webforge\Trello\Test;

class HelperTest extends \Webforge\Code\Test\Base {
  
  public function setUp() {
    parent::setUp();

    $this->helper = new Helper();
  }

  public function testTheHelperReturnsTheSymfonyContainer() {
    $this->assertInstanceOf('Symfony\Component\DependencyInjection\ContainerInterface', $container = $this->helper->getContainer());
  }

  public function testContainerHasClient() {
    $this->assertInstanceOf('GuzzleHttp\Client', $this->helper->getContainer()->get('http.client'));
  }
}
