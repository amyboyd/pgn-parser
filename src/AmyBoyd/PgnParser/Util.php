<?php

namespace AmyBoyd\PgnParser;

class Util
{
  public static function foreignLettersToEnglishLetters($text)
  {
    static $translations = array(
      'Š' => 'S', 'š' => 's', 'Đ' => 'Dj', 'đ' => 'dj', 'Ž' => 'Z', 'ž' => 'z', 'Č' => 'C', 'č' => 'c', 'Ć' => 'C', 'ć' => 'c',
      'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E',
      'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O',
      'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Þ' => 'B', 'ß' => 'Ss',
      'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'a', 'ç' => 'c', 'è' => 'e', 'é' => 'e',
      'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o',
      'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ý' => 'y', 'ý' => 'y', 'þ' => 'b',
      'ÿ' => 'y', 'Ŕ' => 'R', 'ŕ' => 'r',
      '´' => "'"
    );

    $text = str_replace(
      array_keys($translations), $translations, $text
    );

    return utf8_decode($text);
  }

  public static function titleCaseIfCurrentlyAllCaps($text)
  {
    return (strtoupper($text) === $text ? ucwords(strtolower($text)) : $text);
  }

  private static $commonAbbreviationsForUnknownPlayer = array(
    '?', 'nn', 'anonymous', 'unknown'
  );

  public static function normalizePlayerName($name)
  {
    if (in_array(strtolower($name), self::$commonAbbreviationsForUnknownPlayer)) {
      return null;
    }

    $name = self::foreignLettersToEnglishLetters($name);
    $name = self::titleCaseIfCurrentlyAllCaps($name);

    // Some cultures abbreviate with .. unlike English which uses a single dot.
    $name = str_replace('..', '.', $name);

    return $name;
  }
}
