<?php
// $cookie_file = "cookies.txt";
// $url = 'http://www.saveur.com';
// $c = curl_init($url);
// curl_setopt($c, CURLOPT_FRESH_CONNECT, 1);
// curl_setopt($c, CURLOPT_COOKIEJAR, $cookie_file);
// curl_setopt($c, CURLOPT_COOKIEFILE, $cookie_file);
// curl_setopt($c, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:17.0) Gecko/20100101 Firefox/17.0");
// curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
// curl_setopt($c, CURLOPT_FOLLOWLOCATION, 1);
// $z = curl_getinfo($c);
// $s = curl_exec($c);
// curl_close($c);
//
// parse_str($s, $txArr);
// var_dump($txArr);

function download_page($url, $out_file = "body.txt") {
    //$cookie_file = "cookies.txt";
    $fp = fopen($out_file, "w");
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
    //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    //curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
    //curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
    curl_setopt($ch, CURLOPT_FILE, $fp);

    curl_exec($ch);
    fclose($fp);
    $details = curl_getinfo($ch);
    curl_close($ch);

    return $details;
}

$url = "http://www.saveur.com";
download_page($url);

// // create curl resource
// $ch = curl_init();
//
// // set url
// curl_setopt($ch, CURLOPT_URL, "http://www.saveur.com");
//
// //return the transfer as a string
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
//
// // $output contains the output string
// $output = curl_exec($ch);
//
// // close curl resource to free up system resources
// curl_close($ch);
// print_r($output);
