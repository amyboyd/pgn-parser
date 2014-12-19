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
}
