<?php
// This page will compile JSON data for ajax
// or direct http authoring in php.

// Thanks to John Schlick for PHP Simple HTML DOM Parser
// http://simplehtmldom.sourceforge.net/manual.htm

// SITES available for use in this function:
// https://food52.com/recipes :: 'Food 52'

// BEGIN CODE ::

// INCLUDE simple_html_dom.php
include("simple_html_dom.php");

// ARRAY OF SITES TO RETRIVE DATA FROM
// includes a name, number of posts to retrieve, a long url and a short to append links to
$https = array(
  array(
    'name' => 'Food52',
    'toget' => '6',
    'long' => 'https://food52.com',
    'short' => 'https://food52.com',
  ),
  array(
    'name' => 'Epicurious',
    'toget' => '6',
    'long' => 'https://www.epicurious.com/recipes-menus',
    'short' => 'https://www.epicurious.com',
  ),
  array(
    'name' => 'Lucky',
    'toget' => '6',
    'long' => 'http://luckypeach.com/features/',
    'short' => 'http://www.luckypeach.com',
  ),
  array(
    'name' => 'Saveur',
    'toget' => '6',
    'long' => 'http://www.saveur.com',
    'short' => 'http://www.saveur.com',
  )
);


function latest_posts ($https, $json='' ){
  include_once "script/curl.php";
  //ScCurl::download_page($url = "http://www.Surfing-Chef.com", $out_file = "pages/body.html");

  // get length of $https
  // all following code uses incremented var to poplate array
  $num_feeds = count($https);
  $counter = 0;

  // Create $post_array
  $posts_array = array();
  global $posts_array;

  //  FOOD52
  if ($https[$counter]['name'] == 'Food52' || 'Food 52') {
    // RETRIEVE PERTINENT VARIABLES FROM ARRAY OF SITE DATA (array: $http)
    $site = $https[$counter]['name'];
    $toget = $https[$counter]['toget'];
    $url_short = $https[$counter]['short'];
    $url_long = $https[$counter]['long'];

    // Create $html object
    $html = file_get_html($url_long);

    // POPULATE POST_ARRAY
    //create a loop $num_post times to populate $post_array
    $count = 0;

    // while($count < $toget) {
    //   $containers = $html->find("div.home-tile a.image > img");
    //   // headings
    //   $heading =  $containers[$count]->alt;
    //   $posts_array[$site][$count]['heading'] = $heading;
    //   // images
    //   $img_url_attr = 'data-pin-media';
    //   $image =  $containers[$count]->$img_url_attr;
    //   $posts_array[$site][$count]['image'] = $image;
    //   // links
    //   $url =  $containers[$count]->src;
    //   $posts_array[$site][$count]['url'] = $url;
    //   $count ++;
    // }
    $counter++;
  }
  //  EPICURIOUS
  if ($https[$counter]['name'] == 'Epicurious') {
    // RETRIEVE PERTINENT VARIABLES FROM ARRAY OF SITE DATA (array: $http)
    $site = $https[$counter]['name'];
    $toget = $https[$counter]['toget'];
    $url_short = $https[$counter]['short'];
    $url_long = $https[$counter]['long'];

    // Create $html object
    $html = file_get_html($url_long);

    // POPULATE POST_ARRAY
    // create a loop $num_post times to populate $post_array
    $count = 0;

    // while($count < $toget) {
    //   // headings
    //   $headings = $html->find("article.article-featured-item > header > h4");
    //   $heading = $headings[$count]->plaintext;
    //   $posts_array[$site][$count]['heading'] = $heading;
    //   // images
    //   $img_url_attr = 'data-srcset';
    //   $pictures = $html->find("article.article-featured-item > picture > source[media=(min-width: 1024px)]");
    //   // array of two comma delimited attibutes returned from srcset
    //   $images = explode (', ', $pictures[$count]->$img_url_attr);
    //   // extract first attibute
    //   $image =  'https:'.$images[0];
    //   $posts_array[$site][$count]['image'] = $image;
    //   // links
    //   $links = $html->find("article.article-featured-item > a");
    //   $link = $url_short.$links[$count]->href;
    //   $posts_array[$site][$count]['url'] = $link;
    //   $count++;
    // }
    $counter++;
  }
  //  LUCKY PEACH
  if ($https[$counter]['name'] == 'Lucky') {
    // RETRIEVE PERTINENT VARIABLES FROM ARRAY OF SITE DATA (array: $http)
    $site = $https[$counter]['name'];
    $toget = $https[$counter]['toget'];
    $url_short = $https[$counter]['short'];
    $url_long = $https[$counter]['long'];

    // Create $html object
    $html = file_get_html($url_long);

    // POPULATE POST_ARRAY
    // create a loop $num_post times to populate $post_array
    $count = 0;

    // while($count < $toget) {
    //   // headings
    //   $headings = $html->find("div.archive-list--content div.entry-title h2 a");
    //   $heading = $headings[$count]->plaintext;
    //   $posts_array[$site][$count]['heading'] = $heading;
    //   // images
    //   $pictures = $html->find("div.archive-list--img a img");
    //   $picture = $pictures[$count]->src;
    //   $posts_array[$site][$count]['image'] = $picture;
    //   // links
    //   $links = $html->find("div.archive-list--content div.entry-title h2 a");
    //   $link = $links[$count]->href;
    //   $posts_array[$site][$count]['url'] = $link;
    //   $count++;
    // }
    $counter++;
  }
  //  SAVEUR
  if ($https[$counter]['name'] == 'Saveur') {
    // RETRIEVE PERTINENT VARIABLES FROM ARRAY OF SITE DATA (array: $http)
    $site = $https[$counter]['name'];
    $toget = $https[$counter]['toget'];
    $url_short = $https[$counter]['short'];
    $url_long = $https[$counter]['long'];

    // create storage container path
    $storage_container = "pages/$site.html";
    // call to ScClass for download_page method
    ScCurl::download_page($url_short, $storage_container);

    // Create $html object
    $html = file_get_html($storage_container);

    // POPULATE POST_ARRAY
    // create a loop $num_post times to populate $post_array
    $count = 0;
    //
    // while($count < $toget) {
    //   // headings
    //   $headings = $html->find("li.views-row div div div div.pane-node-title h3 a");
    //   $heading = $headings[$count]->plaintext;
    //   $posts_array[$site][$count]['heading'] = $heading;
    //   // images
    //   $img_url_attr = 'data-xlsrc';
    //   $pictures = $html->find("li.views-row div div div div.pane-node-field-image div a img");
    //   $images = explode ('?', $pictures[$count]->$img_url_attr);
    //   // extract first extracted string in created array object
    //   $image = $images[0];
    //   $posts_array[$site][$count]['image'] = $image;
    //   // links
    //   $links = $html->find("li.views-row div div div div.pane-node-title h3 a");
    //   $link = "$url_short".$links[$count]->href;
    //   $posts_array[$site][$count]['url'] = $link;
    //   $count++;
    // }
    $counter++;
  }
  // returns JSON data
  echo json_encode($posts_array);
} // end function latest_posts()

// CALL function
latest_posts ($https);

?>
