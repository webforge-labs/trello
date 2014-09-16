<?php

namespace Webforge\Trello;

class ApiTest extends \Webforge\ProjectStack\Test\Base {
  
  public function setUp() {
    $this->chainClass = __NAMESPACE__ . '\\Api';
    parent::setUp();

    // always create a new symfony container with a new reference to the trello.api
    $this->resetAndBootKernel();

    // set doctrine from the current symfony container
    $this->initHelper();

    $this->api = $this->get('trello.api');

    $this->executeOnce(
      $this->helper->fixtureParts()
    );
  }

  public function testBoardsAreInsertedIntoTheDBWhenARequestIsMade() {
    $this->resetDatabaseOnNextTest();
    $this->api->synchronizeMyBoards();
    $this->api->flush();

    $boards = $this->em->getRepository('Webforge\Trello\Entities\Board')->findAll();

    $this->assertArrayEquals(
      array('tiptoi', 'Welcome Board'),
      array_map(function($board) {
        return $board->getName();
      }, $boards)
    );

    $this->assertBoardsInDB(array('tiptoi', 'Welcome Board'));
  }

  public function testSynchingTwiceWithFlushesIsPossible() {
    $this->resetDatabaseOnNextTest();
    $this->api->synchronizeMyBoards();
    $this->api->flush();

    $this->api->synchronizeMyBoards();
    $this->api->flush();

    $this->assertBoardsInDB(array('tiptoi', 'Welcome Board'));
  }

  public function testSynchingTwiceWithoutFlushesIsPossible() {
    $this->resetDatabaseOnNextTest();
    $this->api->synchronizeMyBoards();
    $this->api->synchronizeMyBoards();
    $this->api->flush();

    $this->assertBoardsInDB(array('tiptoi', 'Welcome Board'));
  }

  protected function assertBoardsInDB(Array $boardNames)  {
    $boards = $this->em->getRepository('Webforge\Trello\Entities\Board')->findAll();

    $this->assertArrayEquals(
      $boardNames,
      array_map(function($board) {
        return $board->getName();
      }, $boards)
    );

  }
}
