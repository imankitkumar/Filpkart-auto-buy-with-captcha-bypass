<?php

/***
 https://github.com/imankitkumar/
Filpkart-auto-buy-with-captcha-bypassed
                                ***/

include('curl_client.php');
include('api_handler.php');
include('config.php');

$post_data = '{"checkoutType":"PHYSICAL","cartRequest":{"pageType":"ProductPage","cartContext":{"'.$cart_context.'":{"productId":"'.$set_product_id.'","quantity":'.$quantity.',"cashifyDiscountApplied":false,"vulcanDiscountApplied":false}}}}';

/***
 adding selected

    product
  
    to your cart
                   ***/

$res = json_decode(curlPost($api1, $post_data, $headers), true);

if($res['STATUS_CODE'] === 200) {

$res = json_decode(curlGet($api2, $headers), true);
$parse = $res['RESPONSE']['getPaymentToken']['token'];

$captcha_res = json_decode(curlGet(''.$api3.''.$parse.'', $headers), true);


/***
    bypassing
       captcha verification
                             ***/

$captcha_id = $captcha_res['captcha_image']['id'];
$captcha_image = $captcha_res['captcha_image']['image'];

$bypass_captcha = json_decode(curlPost($api4, '{
  "userid": "arun56",
  "apikey": "wMjXmBIcHcdYqO2RrsVN",
  "data": "'.$captcha_image.'" }',''), true); //@captcha bypassed
  
/*** verifying 
         captcha
               text 
                     ***/

$post_field = '{
  "token": "'.$parse.'",
  "device_capabilities": {
    "read_sms": false,
    "phonepe_sdk": false,
    "juspay_sdk": false,
    "nda_enabled": false,
    "upi_enabled": false,
    "phonepe_sdk_version": null,
    "phonepe_device_id": null
  },
  "payment_instrument": "COD",
  "is_diff_shown_to_user": false,
  "captcha_text": {
    "id": "'.$captcha_id.'",
    "text": "'.$bypass_captcha['result'].'"
  }
}'; 


/*** extracting all 
            @required values 
                  for processing 
                            transaction.  
                                             ***/

$decode_param = json_decode(curlPost($api5, $post_field, $headers), true);

$tid = $decode_param['primary_action']['parameters']['pg_trackid'];
$tamt = $decode_param['primary_action']['parameters']['transaction_amount'];

$zippyid = $decode_param['primary_action']['parameters']['payzippy_transaction_id'];
$merchant_id = $decode_param['primary_action']['parameters']['merchant_user_id'];

$txn_time = $decode_param['primary_action']['parameters']['transaction_time'];
$merchant_ref = $decode_param['primary_action']['parameters']['merchant_reference_id'];

$merchant_txn_id = $decode_param['primary_action']['parameters']['merchant_transaction_id'];


/***
    process to extract
         primary 
      transaction id 
                      ***/

$primary = $decode_param['primary_action']['parameters']['primary_record'];

$pr = explode('transaction_id', $primary)[1];

$pr_id = explode('":"',$pr)[1];

$prr = strtok($pr_id,'"'); //@final primary txn id

$payment_hash = $decode_param['primary_action']['parameters']['hash'];


/***  making 
            final POST request.
                                 ***/

$final_data = 'cod_selected_in_part_payment=false
&
transaction_status=SUCCESS
&
account_type=CURRENT
&
pg_trackid='.$tid.'
&
merchant_adjustments=[]
&
transaction_amount='.$tamt.'
&
emi_months=0
&
merchant_id=mp_flipkart
&
transaction_response_code=SUCCESS
&
payzippy_transaction_id='.$zippyid.'
&
merchant_user_id='.$merchant_id.'
&
having_multiple_transactions=false
&
hash_method=SHA256
&
transaction_time='.$txn_time.'
&
merchant_reference_id='.$merchant_ref.'
&
transaction_currency=INR
&
payment_method=PAYZIPPY
&
timestamp=0
&
merchant_key_id=payment
&
primary_record={"transaction_id":"'.$prr.'","primary_amount":'.$tamt.'}
&
merchant_transaction_id='.$merchant_txn_id.'
&
bank_transaction_id='.$zippyid.'
&
iris_transaction_response_message={"iris_key":"SUCCESS","parameters":{},"default_text":"The+transaction+is+successful"}
&
payment_instrument=COD
&
payment_amount='.$tamt.'
&
transaction_response_message=The+transaction+is+successful
&
sale_txn_status=SUCCESS
&
pg_mid=cod
&
pg_name=cod
&
pg_id=cod
&
is_international=false
&
is_risky_instrument=false
&
hash='.$payment_hash.'';


/*** removing 
     all whitespaces
                     ***/

$removews = preg_replace('/\s+/', '', $final_data);


/*** Final 
         response
                   ***/

$status = json_decode(curlPost($api6, $removews, $headers2), true);

$confirm_order = $status['RESPONSE']['checkoutComplete'];
$order_email = $status['SESSION']['email'];

echo 'was Order Success ? <h2 style="color:green">'.$confirm_order.'</h2><br>
      Order Email: <h2 style="color:green">'.$order_email.'</h2><br>
      Quantity: <h2 style="color:green">'.$quantity.'</h2>';
}

else {

//error

echo "Invalid cart context / Invalid Cookie / Product Out Of Stock";
echo '<head>
  <meta http-equiv="refresh" content="0">
</head>';

}

?>
