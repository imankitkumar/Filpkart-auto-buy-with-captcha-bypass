<?php

$timestamp = time(); 

//POST
$api1 = "https://1.rome.api.flipkart.com/api/5/checkout?infoLevel=order_summary";

//GET
$api2 = "https://1.rome.api.flipkart.com/3/checkout/paymentToken?v=$timestamp";

//POST
$api3 = "https://2.payments.flipkart.com/fkpay/api/v3/payments/captcha/";

//POST
$api4 = "https://api.apitruecaptcha.org/one/gettext";

//POST
$api5 = "https://2.payments.flipkart.com/fkpay/api/v3/payments/pay?instrument=COD";

//POST
$api6 = "https://1.rome.api.flipkart.com/api/3/checkout/pgResponse/msite?redirect_domain=https://www.flipkart.com&callback=true";
?>