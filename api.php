<?php

# main function for curl requests
function apiRequest($url, $post=FALSE, $headers=array()) {
    $ch = curl_init($url);
  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Linux useragent'); //change agent string
  
    if($post)
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
  
    $headers[] = 'Accept: application/json';
  
    # add access token to header 
    if(session('access_token'))
      $headers[] = 'Authorization: Bearer ' . session('access_token');
  
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  
    $response = curl_exec($ch);
    return json_decode($response); //decode response
  }
  
  # array key existence
  function get($key, $default=NULL) {
    return array_key_exists($key, $_GET) ? $_GET[$key] : $default;
  }
  
  # array key existence
  function session($key, $default=NULL) {
    return array_key_exists($key, $_SESSION) ? $_SESSION[$key] : $default;
  }
?>