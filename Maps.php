<?php
/**
 * Obtendo Latitude e Longitude via Google Maps Api V2
 * @author Roni -  roni@bananadev.com.br
 */

class Maps {

  //chave publica de acesso
  private static $googleKey = 'SUA_CHAVE_AQUI';

  static function loadUrl($url){
    $cURL = curl_init($url);
    curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($cURL, CURLOPT_FOLLOWLOCATION, true);
    $result = curl_exec($cURL);
    curl_close($cURL);

    if($result) {
      return $result;
    }else{
      return false;        
    }
  }

  static function getLocal($address) {
    $url = 'https://maps.googleapis.com/maps/api/geocode/json?address='. urlencode($address) .'&key='.self::$googleKey;    
    $result = self::loadUrl($url);

    $json = json_decode($result);

    if($json->{'status'} == 'OK') {        
      return $json->{'results'}[0]->{'geometry'}->{'location'};  
    }else{
      return false;
    }
    
  }
}
