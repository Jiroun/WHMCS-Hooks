<?php
/**
 * Hide paymentGateways And credit Card InputFields When Total at Cart Checkout is Zero
 * @package     WHMCS
 * @author      Aladdin Jiroun
 */


if (!defined("WHMCS"))
    die("This file cannot be accessed directly");

add_hook('ClientAreaPageCart', 1, function($vars) {
    
    if ($vars['rawtotal'] == 0.00)
    {
        add_hook('ClientAreaFooterOutput', 1, function($vars) {
            
        $return = '
    <script>
const PGC = document.getElementById("paymentGatewaysContainer");
const CCIF = document.getElementById("creditCardInputFields");
PGC.style.display = "none";
CCIF.style.display = "none";
</script>
    ';
        return $return;
        }); 
    }
    
});
