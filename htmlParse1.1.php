<?php
// http://simplehtmldom.sourceforge.net/manual.htm

// INCLUDE simple_html_dom.php
include("simple_html_dom.php");

$url = "https://food52.com/recipes";

function latest_feeds ($url, $num_posts){
  // DEFINITIONS
  // webpage
  $page = $url;

  // Create $html object
  $html = file_get_html($url);

  // Create $post_array
  $post_array = array();
  global $post_array;

  // POPULATE POST_ARRAY
  // create a loop $num_post times to populate $post_array
  $count = 0;
  while($count < 7) {

    // Target image
    // $picture = $html->find("div.collectable-tile, $count")[0];
    // print_r($picture);
    // Target heading

    // Target link
    echo $count."</br>"
    $count+=1;
  }
}

latest_feeds ($url, 1);
?>
