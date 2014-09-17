<?php

namespace Webforge\Trello;

/**
 * 
 * 
 * unit tests marked with @unit-test might be moved to an unit test for the synchronizer (it could just trigger invents and mock the persister)
 */
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

    $this->cardsRepository = $this->em->getRepository('Webforge\Trello\Entities\Card');
    $this->boardsRepository = $this->em->getRepository('Webforge\Trello\Entities\Board');
  }

  public function testBoardsAreInsertedIntoTheDBWhenARequestIsMade() {
    $this->resetDatabaseOnNextTest();
    $this->api->synchronizeMyBoards();
    $this->api->flush();

    $boards = $this->boardsRepository->findAll();

    $this->assertArrayEquals(
      array('tiptoi', 'Welcome Board'),
      array_map(function($board) {
        return $board->getName();
      }, $boards)
    );

    $this->assertBoardsInDB(array('tiptoi', 'Welcome Board'));
  }

  /**
   * @group cards
   */
  public function testBoardCardsAreInserted() {
    $this->resetDatabaseOnNextTest();
    $this->api->synchronizeMyBoards();
    $this->api->flush();

    $boards = $this->boardsRepository->findAll();
    foreach ($boards as $board) {
      $this->api->synchronizeBoardCards($board);
    }
    $this->api->flush();

    $cards = $this->cardsRepository->findAll();
    $this->assertCount(19+2, $cards);
  }

  /**
   * @group cards
   */
  public function testBoardCardsAreSavedForBoards() {
    $this->resetDatabaseOnNextTest();
    $boards = $this->api->synchronizeMyBoards();
    foreach ($boards as $board) {
      $this->api->synchronizeBoardCards($board);
    }
    $this->api->flush();

    $qb = $this->cardsRepository->createQueryBuilder('card');
    $qb->leftJoin('card.board', 'board');
    $qb->where($qb->expr()->eq('board.name', ':boardName'));
    
    $tiptoiCards = $qb->setParameter('boardName', 'tiptoi')->getQuery()->getResult();

    $this->assertCount(2, $tiptoiCards);
  }

  /**
   * @group unit-test
   */
  public function testSynchingTwiceWithFlushesIsPossible() {
    $this->resetDatabaseOnNextTest();
    $this->api->synchronizeMyBoards();
    $this->api->flush();

    $this->api->synchronizeMyBoards();
    $this->api->flush();

    $this->assertBoardsInDB(array('tiptoi', 'Welcome Board'));
  }

  /**
   * @group unit-test
   */
  public function testSynchingTwiceWithoutFlushesIsPossible() {
    $this->resetDatabaseOnNextTest();
    $this->api->synchronizeMyBoards();
    $this->api->synchronizeMyBoards();
    $this->api->flush();

    $this->assertBoardsInDB(array('tiptoi', 'Welcome Board'));
  }

  protected function assertBoardsInDB(Array $boardNames)  {
    $boards = $this->boardsRepository->findAll();

    $this->assertArrayEquals(
      $boardNames,
      array_map(function($board) {
        return $board->getName();
      }, $boards)
    );

  }
}
