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
    
    /**
     * 32-bit Bitvector Handling: Check if a flag is set
     * 
     * @param int $bv   : Bitvector value (Binary flags)
     * @param int $flag : Flag position (0=first)
     * @return bool
     */
    public function check_bv($bv, $flag)
    {
      $bin_flag = (1 << ($flag));

      if (($bv & $bin_flag) == $bin_flag) return TRUE;
      else                                return FALSE;
    }

    /**
     * 32-bit Bitvector Handling: Set a bitvector flag (or leave set)
     * 
     * @param int $bv   : Bitvector value (Binary flags)
     * @param int $flag : Flag position (0=first)
     * @return int      : New bitvector value
     */
    public function set_bv($bv, $flag)
    {
      $bin_flag = (1 << ($flag));

      $ret = ($bv | $bin_flag);
      return $ret;
    }

    /**
     * 32-bit Bitvector Handling: Unset a bitvector flag (or leave unset)
     * 
     * @param int $bv   : Bitvector value (Binary flags)
     * @param int $flag : Flag position (0=first)
     * @return int      : New bitvector value
     */
    public function remove_bv($bv, $flag)
    {
      $bin_flag = (1 << ($flag));

      if (($bv & $bin_flag) == $bin_flag) {
        $ret = ($bv & (~($bin_flag)));
      } else {
        $ret = $bv;
      }
      return $ret;
    }

  }

}
