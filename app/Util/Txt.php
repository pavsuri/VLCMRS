<?php namespace Util;

class Txt {

  // source: http://stackoverflow.com/a/14467470
  /**
   * Convert all line-breaks within a string of text to separate paragraphs.
   * @param  string $string string of text to separate
   * @param  boolean $escape whether the string should be escaped first for safety
   * @return string         html string with paragraphs
   */
  public static function newLineToParagraph($string, $escape = true)
  {
    if ($escape) $string = htmlentities($string);

    // replace \n's
    $string = str_replace('\n', '</p><p>', $string);

    // replace hidden new lines (from database fields usually)
    $string = preg_replace('#\R+#', '</p><p>', $string);

    return '<p>'.$string.'</p>';
  }

  public static function cutToClosestWord($content, $characters = 150)
  {
    $pos = strpos($content, ' ', $characters);
    return substr($content, 0, $pos);
  }

  public static function stripWhiteSpace($text)
  {
    return str_replace(' ', '', $text);
  }

}
