<?php
class ScCurl
{
  // create cURL function
  public static function download_page($url, $out_file = "pages/body.html") 
  {
    $fp = fopen($out_file, "c");
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_FILE, $fp);

    curl_exec($ch);
    fclose($fp);
    $details = curl_getinfo($ch);
    curl_close($ch);

    return $details;
  }
}
