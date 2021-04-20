<?php

namespace AmyBoyd\PgnParser;

class PgnParser extends ParserAbstract
{

  /**
   * @param string $filePath The absolute or relative path to a file. Must not be a directory.
   */
  public function __construct($filePath)
  {
    parent::__construct($filePath);
  }

}
