<?php

//Make POST REQUESTS

function curlPost($api_url, $post_data, $headers){

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $api_url);

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    curl_setopt($ch, CURLOPT_HEADER, 0);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  
    curl_setopt($ch, CURLOPT_POST, 1);

    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

    $response = curl_exec($ch);

    curl_close($ch);

    return $response;
    
    }
 
   
//Make GET REQUESTS
    
function curlGet($api_url, $headers){

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $api_url);

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    curl_setopt($ch, CURLOPT_HEADER, 0);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
  
    $response = curl_exec($ch);

    curl_close($ch);

    return $response;
    
    }
    

?>
