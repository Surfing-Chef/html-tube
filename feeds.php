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
    'toget' => '5',
    'long' => 'https://food52.com/blog',
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

function latest_posts ($https, $json='' ){

  // get length of $https
  // all following code uses incremented var to poplate array
  $num_feeds = count($https);
  $counter = 0;
  //while(){
    // place main code here for looping and populating array
  //};

  // RETRIEVE PERTINENT ARRAY INFO FOR PARSING JSON
  $site = $https[0]['name'];
  $toget = $https[0]['toget'];
  $url_short = $https[0]['short'];
  $url_long = $https[0]['long'];

  // Create $html object
  $html = file_get_html($url_long);

  // Create $post_array
  $posts_array = array();
  global $posts_array;

  //FOOD52

  if ($https[0]['name'] == 'Food52' || 'Food 52') {
    // POPULATE POST_ARRAY
    // create a loop $num_post times to populate $post_array
    $count = 0;

    while($count < $toget) {
      $container = array();
        // $num_headings = 0;
        // find the headings
        $headings = $html->find('a[class=topic-index-topic-label]');
        // populate $posts_array with the selected headings
        foreach($headings as $heading){
          //echo $heading->plaintext.'</br>';
          $container[$site]['heading'][] = $heading->plaintext;
        }

          // find the descriptions
          $descriptions = $html->find('div[class=topic-index-tile] > h3 > a');
          foreach($descriptions as $description){
              //echo $description->plaintext.'</br>';
              $container[$site]['description'][]= $description->plaintext;
          }

          // find the images
          $media = "data-pin-media";
          $images = $html->find('div[class=topic-index-tile] > a img');
          foreach($images as $image){
              $container[$site]['image'][] = $image->$media;
          }

          // find the links
          $urls = $html->find('div[class=topic-index-tile] > h3 > a');
          foreach($urls as $url){
            $container[$site]['link'][] = $url_short.$url->href;
          }
        $count ++;
        }
      //}
    //}
  }
  // if ($https[0]['name'] == 'Food52' || 'Food 52') {
  //   // POPULATE POST_ARRAY
  //   // create a loop $num_post times to populate $post_array
  //   $count = 0;
  //
  //   while($count < $toget) {
  //
  //     if ($count < 1){
  //       // Target header
  //       $heading_container = $html->find("div.topic-page-body h2 a");
  //       $heading = $heading_container[$count]->plaintext;
  //       echo $heading.'</br>';
  //       $posts_array[$site][$count]['heading'] = $heading;
  //       // Target image
  //       $media = 'data-pin-media';
  //       $image_container = $html->find("div.topic-page-body div.topic-index-group div.topic-index-tile a img");
  //       $image = $image_container[$count]->$media;
  //       echo $image.'</br>';
  //       $posts_array[$site][$count]['image'] = $image;
  //       // Target description
  //       $description_container = $html->find("div.topic-page-body div.topic-index-group div.topic-index-tile h3");
  //       $description = $description_container[$count]->plaintext;
  //       echo $description.'</br>';
  //       $posts_array[$site][$count]['description'] = $description;
  //       // Target link
  //       $link_container = $html->find("div.topic-page-body div.topic-index-group div.topic-index-tile h3 a");
  //       $link = $url_short.$link_container[$count]->href;
  //       echo $link.'</br>'.'</br>';
  //       $posts_array[$site][$count]['link'] = $link;
  //       $count ++;
  //     }
  //     if ($count > 0){
  //       $cont = "div.topic-page-wrapper:nth-child(3) > div > ";
  //       // Target header
  //       $heading_container = $html->find($cont."h2 a.topic-index-topic-label");
  //       $heading = $heading_container[$count]->plaintext;
  //       echo $heading.'</br>';
  //       $posts_array[$site][$count]['heading'] = $heading;
  //       // Target description
  //
  //       $description_container = $html->find('.block-container > div:nth-child(3) .topic-index-title div div div a > h3 > a');
  //       $description = $description_container[0]->plaintext;
  //       echo $description.'</br>';
  //
  //       $posts_array[$site][$count]['description'] = $description;
  //
  //       $count ++;
  //     }
  //   }
  // }
  // // returns JSON data
  echo json_encode($container);
} // end function latest_posts()

// CALL function
latest_posts ($https);

?>
