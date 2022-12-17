<?php
/**
 * Hide paymentGateways And credit Card InputFields When Total at Cart Checkout is Zero
 * @package     WHMCS
 * @author      Aladdin Jiroun
 */

if (!defined("WHMCS"))
    die("This file cannot be accessed directly");


// You Will need to select Payment Mithod something another that credit card like paypal or paypalcheckout
// edit to paypalcheckout if you using this module 

add_hook('ClientAreaPageCart', 1, function($vars) {
    
    if ($vars['rawtotal'] == 0.00)
    {
        add_hook('ClientAreaFooterOutput', 1, function($vars) {
        $v = "input[value='paypal']";
        $return = '
<script>
    document.querySelector("'.$v.'").checked = true;
    const PGC = document.getElementById("paymentGatewaysContainer");
    PGC.style.display = "none";
    ';
        return $return;
        }); 
    }
});


// add_hook('ClientAreaPageCart', 1, function($vars) {
    
//     if ($vars['rawtotal'] == 0.00)
//     {
//         add_hook('ClientAreaFooterOutput', 1, function($vars) {
            
//         $return = '
// <script>
//     const PGC = document.getElementById("paymentGatewaysContainer");
//     PGC.style.display = "none";
//     setTimeout(function(){
//         const CCIF = document.getElementById("creditCardInputFields");
//         CCIF.style.display = "none"; 
// }, 1000);
// </script>
//     ';
//         return $return;
//         }); 
//     }
    
// });
