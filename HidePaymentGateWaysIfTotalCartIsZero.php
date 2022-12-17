<?php
/**
 * Hide paymentGateways And credit Card InputFields When Total at Cart Checkout is Zero
 * @package     WHMCS
 * @author      Aladdin Jiroun
 */

if (!defined("WHMCS"))
    die("This file cannot be accessed directly");


// IF you Want to Select PayPal TO hide Credit Card InputFields USE THIS HOOK
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


// OR USE THIS WILL HIDE Credit Card InputFields AFTER 1 SECOND 
add_hook('ClientAreaPageCart', 1, function($vars) {
    
    if ($vars['rawtotal'] == 0.00)
    {
        add_hook('ClientAreaFooterOutput', 1, function($vars) {
            
        $return = '
<script>
    const PGC = document.getElementById("paymentGatewaysContainer");
    PGC.style.display = "none";
    setTimeout(function(){
        const CCIF = document.getElementById("creditCardInputFields");
        CCIF.style.display = "none"; 
}, 1000);
</script>
    ';
        return $return;
        }); 
    }
    
});
