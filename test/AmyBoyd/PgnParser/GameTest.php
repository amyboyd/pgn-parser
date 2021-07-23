<?php

use AmyBoyd\PgnParser\Game;
use AmyBoyd\PgnParser\PgnParser;

class GameTest extends PHPUnit_Framework_TestCase
{
    public function testGetAndSetWhiteAndBlack()
    {
        $game = new Game();
        $this->assertEquals(null, $game->getWhite());

        $game->setWhite('Amy Boyd');
        $this->assertEquals('Amy Boyd', $game->getWhite());
    }

    public function testToJSON()
    {
      $file = 'test/data/2010 World Championship.pgn';
      $parser = new PgnParser($file);
      $game = $parser->getGame(5);
      $json = $game->toJSON();

      $this->assertInternalType('string', $json);
      $this->assertInternalType('array', json_decode($json, true));
      $this->assertJsonStringEqualsJsonFile(__DIR__ . '/expected-toJSON-1.json', $json);
    }

    public function testGetMoves()
    {
      $file = 'test/data/200open.pgn';
      $parser = new PgnParser($file);
      $game = $parser->getGame(0);

      $this->assertEquals(
        'e4 e5 Nf3 d6 d4 f5 dxe5 fxe4 Ng5 d5 e6 Nh6 Nc3 c6 Ngxe4 dxe4 Qh5+ g6 Qe5 Rg8 Bxh6 Bxh6 Rd1 Qg5 Qc7 Bxe6 Qxb7 e3 f3 Qe7 Qxa8 Kf7 Ne4 Bf4 Be2 Kg7 O-O Qc7 Nc5 Bxh2+ Kh1 Bc8 Rd4 Bg3 Re4 Kh8 Rd1 Qg7 Rh4 Bxh4 Qxb8 Ba6 Qh2 Bxe2 Rd7 Qh6 Ne4 Bc4 Nf6 e2 Re7 Qc1+ Qg1 Qxg1+ Kxg1 e1=Q+ Rxe1 Bxe1',
        $game->getMoves()
      );
      $this->assertEquals(
        68,
        $game->getMovesCount()
      );
    }

    public function testGetAndSetSite()
    {
        $game = new Game();
        $this->assertEquals(null, $game->getSite());

        $game->setSite('.');
        $this->assertEquals(null, $game->getSite());

        $game->setSite('Russia');
        $this->assertEquals('Russia', $game->getSite());
    }

}
