<?php

namespace AmyBoyd\PgnParser;

class Game
{
  /**
   * The filename of the PGN database this game came from.
   */
  protected $fromPgnDatabase;

  protected $pgn;

  /**
   * All moves concatenated, with move numbers removed. Example: "e4 e5 f4 exf4".
   */
  protected $moves;

  protected $movesCount;

  protected $event;

  protected $site;

  /**
   * Format not guaranteed.
   */
  protected $date;

  protected $round;

  protected $white;

  protected $black;

  protected $result;

  protected $whiteElo;

  protected $blackElo;

  /**
   * Opening ECO code.
   */
  protected $eco;

  /**
   * Set moves
   * @param string $moves
   */
  public function setMoves($moves)
  {
    $moves = trim($moves);

    $this->moves = $moves;
    $this->movesCount = count(explode(' ', $moves));
  }

    /**
     * Get moves
     * @return string
     */
  public function getMoves()
  {
    return $this->moves;
  }

  public function getMovesArray()
  {
    return explode(' ', $this->moves);
  }

    /**
     * Set event
     * @param string $event
     */
  public function setEvent($event)
  {
    if ($event === '?' || $event === '') {
      $this->event = null;
    } else {
      $event = Util::foreignLettersToEnglishLetters($event);
      $event = Util::titleCaseIfCurrentlyAllCaps($event);
      $this->event = $event === '?' ? null : $event;
    }
  }

    /**
     * Get event
     * @return string
     */
  public function getEvent()
  {
    return $this->event;
  }

    /**
     * Set site
     * @param string $site
     */
  public function setSite($site)
  {
    if ($site === '?' || $site === '') {
      $this->site = null;
    } elseif (strlen(preg_replace('/[^a-zA-Z]/', '', $site) < 2)) {
      // Some sites have been non-letter gibberish.
      $this->site = null;
    } else {
      $site = Util::foreignLettersToEnglishLetters($site);
      $site = Util::titleCaseIfCurrentlyAllCaps($site);
      $this->site = $site;
    }
  }

    /**
     * Get site
     * @return string
     */
  public function getSite()
  {
    return $this->site;
  }

    /**
     * Set date
     * @param string $date
     */
  public function setDate($date)
  {
    $this->date = $date;
  }

    /**
     * Get date
     * @return string
     */
  public function getDate()
  {
    return $this->date;
  }

    /**
     * Get year.
     * @return int
     */
  public function getYear()
  {
    if (strlen($this->date) >= 4) {
      $year = substr($this->date, 0, 4);
      $year = str_replace('?', '', $year);

      return ($year ? (int) $year : null);
    }

    return null;
  }

    /**
     * Get the date formatted smartly.
     * @return string
     */
  public function getDatePrettyPrint()
  {
    $date = str_replace('?', '', $this->date);
    $date = explode('.', $date);
    $date = array_filter($date);

    if (count($date) == 2 || count($date) == 3) {
      $month = date('F', mktime(0, 0, 0, $date[1], 1));
      $date = "$month, $date[0]";
    } elseif (count($date) == 1) {
      $date = $date[0];
    } else {
      $date = null;
    }

    return $date;
  }

    /**
     * Get the event and site concatenated smartly.
     * @return string
     */
  public function getEventSitePrettyPrint()
  {
    $eventSite = null;
    if ($this->event && $this->site) {
      if (strpos($this->event, $this->site) !== false) {
        // Event contains site.
        $eventSite = $this->event;
      } else {
        $eventSite = "$this->event, in $this->site";
      }
    } elseif ($this->event) {
      $eventSite = $this->event;
    } elseif ($this->site) {
      $eventSite = $this->site;
    }

    return $eventSite;
    }

  public function getEventSiteDatePrettyPrint()
  {
    $eventSite = $this->getEventSitePrettyPrint();
    $date = $this->getDatePrettyPrint();

    if ($eventSite && $date) {
        return "$eventSite, $date";
    } elseif ($eventSite) {
        return $eventSite;
    } elseif ($date) {
        return $date;
    } else {
        return null;
    }
  }

  /**
   * Set round
   * @param string $round
   */
  public function setRound($round)
  {
    $this->round = $round === '?' ? null : $round;
  }

  /**
   * Get round
   * @return string
   */
  public function getRound()
  {
    return $this->round;
  }

  /**
   * Set white
   * @param string $white
   */
  public function setWhite($white)
  {
    $this->white = Util::normalizePlayerName($white);
  }

  /**
   * Get white
   * @return string
   */
  public function getWhite()
  {
    return $this->white;
  }

  /**
   * Set black
   * @param string $black
   */
  public function setBlack($black)
  {
    $this->black = Util::normalizePlayerName($black);
  }

  /**
   * Get black
   * @return string
   */
  public function getBlack()
  {
    return $this->black;
  }

  /**
   * Set result
   * @param string $result
   */
  public function setResult($result)
  {
    $this->result = ($result === '?' ? null : $result);
  }

  /**
   * Get result
   * @return string
   */
  public function getResult()
  {
    return $this->result;
  }

  /**
   * Set whiteElo
   * @param string $whiteElo
   */
  public function setWhiteElo($whiteElo)
  {
    $this->whiteElo = $whiteElo === '?' ? null : $whiteElo;
  }

  /**
   * Get whiteElo
   * @return string
   */
  public function getWhiteElo()
  {
    return $this->whiteElo;
  }

  /**
   * Set blackElo
   * @param string $blackElo
   */
  public function setBlackElo($blackElo)
  {
    $this->blackElo = $blackElo === '?' ? null : $blackElo;
  }

  /**
   * Get blackElo
   * @return string
   */
  public function getBlackElo()
  {
    return $this->blackElo;
  }

  /**
   * Set eco
   * @param string $eco
   */
  public function setEco($eco)
  {
    $this->eco = $eco === '?' ? null : $eco;
  }

  /**
   * Get eco
   * @return string
   */
  public function getEco()
  {
    return $this->eco;
  }

  /**
   * Set pgn
   * @param string $pgn
   */
  public function setPgn($pgn)
  {
    $this->pgn = trim($pgn);
  }

  /**
   * Get pgn
   * @return string
   */
  public function getPgn()
  {
    return $this->pgn;
  }

  public function getMovesCount()
  {
    return $this->movesCount;
  }

  public function setMovesCount($movesCount)
  {
    $this->movesCount = $movesCount;
  }

  /**
   * Set fromPgnDatabase (file name).
   * @param string $fromPgnDatabase
   */
  public function setFromPgnDatabase($fromPgnDatabase)
  {
    $this->fromPgnDatabase = $fromPgnDatabase;
  }

  /**
   * Get fromPgnDatabase
   * @return string File name.
   */
  public function getFromPgnDatabase()
  {
    return $this->fromPgnDatabase;
  }

  public function toJSON()
  {
    $keys = array('pgn', 'moves', 'movesCount', 'site', 'event',
        'date', 'round', 'white', 'black', 'result', 'whiteElo',
        'blackElo', 'eco');
    $toExport = array();
    foreach ($keys as $key) {
      $toExport[$key] = $this->{$key};
    }

    return json_encode($toExport);
  }
}
