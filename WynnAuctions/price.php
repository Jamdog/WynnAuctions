<?php
/**
 * Wynncraft Auction Price Image
 * Version 1.0
 *
 * @copyright Wynncraft 2014
 * @author Stefan Cole (aka. Jamdoggy) <jamdog@live.co.uk>
 */

// Temp bootstrap class - will mvc later
require_once 'bootstrap.php';

// Check player name is valid (fully-paid-up minecraft user) else exit
$price = array();
$price['emeralds'] = protectInput($_REQUEST['e']);   // Emeralds
$price['blocks']   = protectInput($_REQUEST['eb']);  // Emerald Blocks
$price['liquid']   = protectInput($_REQUEST['le']);  // Liquid Emeralds

if (!isset($price['emeralds']) || !is_numeric($price['emeralds'])) $price['emeralds']=0;
if (!isset($price['blocks'])   || !is_numeric($price['blocks']))   $price['blocks']=0;
if (!isset($price['liquid'])   || !is_numeric($price['liquid']))   $price['liquid']=0;

if ($price['emeralds'] > 63) {  // Convert (over 63) emeralds to blocks
  $leftover = ($price['emeralds'] % 64);
  $price['blocks'] += (($price['emeralds'] - $leftover) / 64);
  $price['emeralds'] = $leftover;
}
if ($price['blocks'] > 63) {    // Convert (over 63) blocks to liquid emeralds
  $leftover = ($price['blocks'] % 64);
  $price['liquid'] += (($price['blocks'] - $leftover) / 64);
  $price['blocks'] = $leftover;
}

// Which image do we use?  Do we need to show blocks/liquids?
if ($price['liquid'] > 0) {            // At least 1 LE, so show LE image
  $priceImg = 'assets/images/bg_le.png';
} else if ($price['blocks'] > 0) {     // No LE, but at least 1 EB
  $priceImg = 'assets/images/bg_eb.png';
} else {                               // None of the above, assume emeralds-only
  $priceImg = 'assets/images/bg_e.png';
}
$img = imagecreatefrompng($priceImg);

// Font Variables
$fontPrice  = 'assets/font/DroidSans.ttf';
$colorPrice = imagecolorallocate($img, 10, 10, 10);
$colorZero  = imagecolorallocate($img, 150, 150, 150);

// Echo Prices
if ($price['liquid'] > 0) {      // At least 1 LE, so show LE price
  imagettftext($img, 10, 0, 12, 14, $colorPrice, $fontPrice, $price['liquid']);
  imagettftext($img, 10, 0, 48, 14, (($price['blocks'] > 0) ? $colorPrice : $colorZero), $fontPrice, $price['blocks']);
  imagettftext($img, 10, 0, 81, 14, (($price['emeralds'] > 0) ? $colorPrice : $colorZero), $fontPrice, $price['emeralds']);
} else if ($price['blocks'] > 0) {      // No LE, but at least 1 EB
  imagettftext($img, 10, 0, 48, 14, $colorPrice, $fontPrice, $price['blocks']);
  imagettftext($img, 10, 0, 81, 14, (($price['emeralds'] > 0) ? $colorPrice : $colorZero), $fontPrice, $price['emeralds']);
} else {
  imagettftext($img, 10, 0, 81, 14, (($price['emeralds'] > 0) ? $colorPrice : $colorZero), $fontPrice, $price['emeralds']);
}

// Render
header('Content-type: image/png');
header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
header('Expires: Thu, 19 Nov 1981 08:52:00 GMT');
header('Pragma: no-cache');

imagepng($img) or die('Imaged failed to load');
imagedestroy($img);
