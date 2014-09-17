<?php
/**
 * Wynncraft Auction Core Application Bootstrap
 * Version 1.0s
 *
 * @copyright Wynncraft 2014
 * @author Stefan Cole (aka. Jamdoggy) <jamdog@live.co.uk>
 */

spl_autoload_register(function ($class) {
  include 'library/' . $class . 'class.php';
});
