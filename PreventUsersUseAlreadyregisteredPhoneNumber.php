<?php
/**
 * Prevent Users Use phone number that already registered with another user
 * @package     WHMCS
 * @author      Aladdin Jiroun
 */

if (!defined("WHMCS"))
    die("This file cannot be accessed directly");

use WHMCS\View\Menu\Item as MenuItem;
use WHMCS\Database\Capsule;

add_hook('ClientDetailsValidation', 1, function($vars) {
    $phonenumber = '+'.$vars['country-calling-code-phonenumber'].".".$vars['phonenumber'];
    $phonenumber = str_replace(' ', '', $phonenumber);
    $phonenumber = str_replace('-', '', $phonenumber);
 
    $client = Capsule::table('tblclients')->whereRaw("REPLACE(REPLACE(`phonenumber`, '-', ''), ' ', '') = ?", [$phonenumber])->first();

    // in case of register
    if ($vars["register"] == "true") 
    {
        if ($client) return ['Phone number already registered'];
    }

    // in case of update deatils
    else {
        $cli = Menu::context('client');
        if (!is_null($cli))
        {
            if ($client)
            {
                $thephoneclient = $client->id;
                $thecurrentclient = $cli->id;
                if ($thephoneclient != $thecurrentclient ) return ['Phone number already registered'];
            }
        }
    }
});

 // in case of register using checkout
add_hook('ShoppingCartValidateCheckout', 1, function($vars) {
    
    if ($vars['custtype']== "new")
    {
        $phonenumber = '+'.$vars['country-calling-code-phonenumber'].".".$vars['phonenumber'];
        $phonenumber = str_replace(' ', '', $phonenumber);
        $phonenumber = str_replace('-', '', $phonenumber);
        $client = Capsule::table('tblclients')->whereRaw("REPLACE(REPLACE(`phonenumber`, '-', ''), ' ', '') = ?", [$phonenumber])->first();
        if ($client) return ['Phone number already registered'];
    }
});
