<?php

use AmyBoyd\PgnParser\PgnParser;
use AmyBoyd\PgnParser\Game;

class PgnParserTest extends PHPUnit_Framework_TestCase
{
  public function testCountGames()
  {
    $files = array(
      '2010 World Championship.pgn' => 12,
      '200open.pgn' => 69
    );

    foreach ($files as $file => $expectedCount) {
      $parser = new PgnParser('test/data/' . $file);
      $this->assertEquals($expectedCount, $parser->countGames());
    }
  }

  public function testGetGames()
  {
    $file = 'test/data/2010 World Championship.pgn';
    $parser = new PgnParser($file);
    $games = $parser->getGames();

    foreach ($games as $game) {
      $this->assertInstanceOf('\AmyBoyd\PgnParser\Game', $game);
    }
  }

  public function testGetGame()
  {
    $file = 'test/data/2010 World Championship.pgn';
    $parser = new PgnParser($file);
    $game = $parser->getGame(1);
    $this->assertInstanceOf('\AmyBoyd\PgnParser\Game', $game);
  }
}
