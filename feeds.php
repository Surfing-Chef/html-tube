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

// array of sites, address and domains
$https = array(
  array(
    'name' => 'Food52',
    'toget' => '4',
    'long' => 'https://food52.com/recipes',
    'short' => 'https://food52.com',
  ),
  array(
    'name' => 'Epicurious',
    'toget' => '4',
    'long' => 'https://www.epicurious.com/recipes-menus',
    'short' => 'https://www.epicurious.com',
  ),
  array(
    'name' => 'Saveur',
    'toget' => '4',
    'long' => 'http://www.saveur.com/food',
    'short' => 'http://www.saveur.com',
  ),
  array(
    'name' => 'Lucky',
    'toget' => '4',
    'long' => 'http://luckypeach.com/features/',
    'short' => 'http://www.luckypeach.com',
  )
);

// $site from list at top, $num_posts to display, $json yes for JSON Output

function latest_posts ($https, $json='' ){
  if ($https[0]['name'] == 'Food52' || 'Food 52') {
    // DEFINITIONS
    $site = $https[0]['name'];
    $toget = $https[0]['toget'];
    $url_short = $https[0]['short'];
    $url_long = $https[0]['long'];

    // Create $html object
    $html = file_get_html($url_long);

    // find specific container
    $array = $html->find("div.collectable-tile h3 a[title]");
    // find specific value
    $value = $array[0]->title;

    // Create $post_array
    $posts_array = array();
    global $posts_array;

    // POPULATE POST_ARRAY
    // create a loop $num_post times to populate $post_array
    $count = 0;

    while($count < $toget) {

      // Target image
      $media = 'data-pin-media';
      $image_container = $html->find("div.photo-block a img");
      $image = $image_container[$count]->$media;
      $posts_array[$site][$count]['image'] = $image;
      // Target heading
      $heading_container = $html->find("div.collectable-tile h3 a[title]");
      $heading = $heading_container[$count]->title;
      $posts_array[$site][$count]['heading'] = $heading;
      // Target link
      $link_container = $html->find("div.collectable-tile h3 a[title]");
      $link = $url_short.$link_container[$count]->href;
      $posts_array[$site][$count]['link'] = $link;
      //increment while loop
      $count += 1;
    }
  }
  // returns JSON data
  echo json_encode($posts_array);
}

// CALL function
latest_posts ($https);

?>
