<?php

// If I call `wrap("hello   world   my name is Johnny-English", 3) I expect to get "hel\nlo\nwor\nld\nmy\nnam\ne\nis\nJoh\nnny\n-En\ngli\nsh" instead I get "hel\nlo \n\nwor\nld \n my\nnam\ne\nis\nJoh\nnny\n-En\ngli\nsh"

final class Wrap {
  /**
   * Wraps a string into lines at a specified length
   *
   * @param string $string Input string
   * @param int $length Number of characters per line
   * @return string Given string wrapped at length specified
   */
  public static function wrap($string, $length) {
    // Make sure $string is appropriate value
    if ($string === '') {
      throw new InvalidArgumentException('$string cannot be empty');

    } else if (ctype_space($string)) {
      throw new InvalidArgumentException('$string cannot be only whitespaces');
    }

    // Make sure $length is appropriate value
    if ($length === 0) {
      throw new InvalidArgumentException('$length cannot be zero');

    } else if ($length < 0) {
      throw new InvalidArgumentException('$length cannot be negative');
    }

    $new_string = '';
    $current_line = '';

    // replace existing breaks with spaces
    $string = str_replace(array("\n", "\r"), ' ', $string);

    // iterate through each word of the string
    foreach (explode(' ', $string) as $word) {
      $word_length = strlen($word);

      // if $current_line + $word_length will be shorter than $length, add word to line
      if ($word_length + strlen($current_line) <= $length) {
        $current_line .= $word . ' ';

      } else {
        if ($current_line !== '' && !ctype_space($current_line)) {
          // add $current_line to $new_string, replace trailing spaces with "\n"
          $new_string .= rtrim($current_line) . "\n";
        }

        // make sure $word_length isn't longer than $length, if so, break $word up into $length wide lines until it is
        while ($word_length > $length) {
          $new_string .= substr($word, 0, $length) . "\n";
          $word = substr($word, $length);
          $word_length = strlen($word);
        }

        // $current line is reset with $word
        $current_line = ltrim($word . ' ');
      }
    }

    // add leftover line to $new_string
    if ($current_line !== '' && !ctype_space($current_line)) {
      $new_string .= rtrim($current_line);
    }

    return $new_string;
  }
}