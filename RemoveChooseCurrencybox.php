<?php
/**
 * Remove Choose Currency box
 * @package     WHMCS
 * @author      Aladdin Jiroun
 */
 
if (!defined("WHMCS"))
    die("This file cannot be accessed directly");

use WHMCS\View\Menu\Item as MenuItem;


add_hook('ClientAreaSecondarySidebar', 1, function(MenuItem $secondarySidebar)
{
   if (!is_null($secondarySidebar->getChild('Choose Currency'))) {
            $secondarySidebar->removeChild('Choose Currency');
   }
});
