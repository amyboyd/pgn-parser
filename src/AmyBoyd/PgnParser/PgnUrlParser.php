<?php

namespace AmyBoyd\PgnParser;

class PgnUrlParser extends ParserAbstract
{

  /**
   * @param string $url An URL to the pgn file.
   */
  public function __construct($url)
  {
    parent::__construct(null, $url);
  }

}
