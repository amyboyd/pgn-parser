<?php

use AmyBoyd\PgnParser\Util;

class UtilTest extends PHPUnit_Framework_TestCase
{
  public function testForeignLettersToEnglish()
  {
    $this->assertEquals(
      'S u \' Ss A',
      Util::foreignLettersToEnglishLetters('Š ù ´ ß Æ')
    );
  }

  public function testTitleCaseIfCurrentlyAllCaps()
  {
    $this->assertEquals(
      'AsD',
      Util::titleCaseIfCurrentlyAllCaps('AsD')
    );
    $this->assertEquals(
      'Hello There',
      Util::titleCaseIfCurrentlyAllCaps('HELLO THERE')
    );
    $this->assertEquals(
      'Ke$ha',
      Util::titleCaseIfCurrentlyAllCaps('KE$HA')
    );
  }

  public function testNormalizePlayerName()
  {
    $this->assertNull(
      Util::normalizePlayerName('?')
    );
    $this->assertNull(
      Util::normalizePlayerName('ANONYMOUS')
    );
    $this->assertEquals(
      'Saaa b. uaaa',
      Util::normalizePlayerName('Šaaa b.. ùaaa')
    );
    $this->assertEquals(
      'Garry Kasparov',
      Util::normalizePlayerName('GARRY KASPAROV')
    );
  }
}
