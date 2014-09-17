<?php
/**
 * Wynncraft Auction Core Functions for Application
 * Version 1.0s
 *
 * @copyright Wynncraft 2014
 * @author Stefan Cole (aka. Jamdoggy) <jamdog@live.co.uk>
 */
namespace wynnbay {
  class Core {

    /**
     * Clean up an input variable for injection into the application.
     *
     * @param $string
     * @return mixed|string
     */
    public static function protectInput($string) {
      $string = stripslashes($string);
      $string = str_replace(array('<', '>', '!', '?', '(', ')', '[', ']'), "", $string);
      $string = htmlspecialchars($string, ENT_HTML5);

      return $string;
    }

  }

}
