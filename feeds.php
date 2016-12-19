<?php
// This page will compile JSON data for ajax
// or direct http authoring in php.

// Thanks to John Schlick for PHP Simple HTML DOM Parser
// http://simplehtmldom.sourceforge.net/manual.htm


// BEGIN CODE ::

// INCLUDE
// simple_html_dom.php
include("scripts/simple_html_dom.php");
// curl.php
include("scripts/curl.php");

// ARRAY OF SITES TO RETRIVE DATA FROM
// includes a name, number of posts to retrieve, a long url and a short to append links to
$https = array(
  array(
    'name' => 'Food52',
    'toget' => '4',
    'long' => 'https://food52.com',
    'short' => 'https://food52.com',
  ),
  // array(
  //   'name' => 'Epicurious',
  //   'toget' => '4',
  //   'long' => 'https://www.epicurious.com/recipes-menus',
  //   'short' => 'https://www.epicurious.com',
  // ),
  array(
    'name' => 'Lucky Peach',
    'toget' => '4',
    'long' => 'http://luckypeach.com/features/',
    'short' => 'http://www.luckypeach.com',
  ),
  array(
    'name' => 'Saveur',
    'toget' => '4',
    'long' => 'http://www.saveur.com',
    'short' => 'http://www.saveur.com',
  )
);


function latest_posts ($https, $json='' ){

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

    // create storage container path
    $storage_container = "pages/$site.html";

    // Check if created page exists,
    // create one if not, update it if
    // page is older than a day.
    if (file_exists($storage_container)) {
      $age = (time()-filemtime($storage_container));
      if ($age > 60*60*12) {
        // call to ScClass for download_page method
        ScCurl::download_page($url_short, $storage_container);
      }
    } else if (!file_exists($storage_container)) {
      // call to ScClass for download_page method
      ScCurl::download_page($url_short, $storage_container);
    }

    // Create $html object
    $html = file_get_html($storage_container);

    // POPULATE POST_ARRAY
    //create a loop $num_post times to populate $post_array
    $count = 0;

    while($count < $toget) {
      $containers = $html->find("div.home-tile a.image > img");
      // headings
      $heading =  $containers[$count]->alt;
      $posts_array[$site][$count]['heading'] = $heading;
      // images
      $img_url_attr = 'data-pin-media';
      $image =  $containers[$count]->$img_url_attr;
      $posts_array[$site][$count]['image'] = $image;
      // links
      $url =  $containers[$count]->src;
      $posts_array[$site][$count]['url'] = $url;
      $count ++;
    }
    $counter++;
  }
  //  EPICURIOUS
  // if ($https[$counter]['name'] == 'Epicurious') {
  //   // RETRIEVE PERTINENT VARIABLES FROM ARRAY OF SITE DATA (array: $http)
  //   $site = $https[$counter]['name'];
  //   $toget = $https[$counter]['toget'];
  //   $url_short = $https[$counter]['short'];
  //   $url_long = $https[$counter]['long'];
  //
  //   // Create $html object
  //   $html = file_get_html($url_long);
  //
  //   // POPULATE POST_ARRAY
  //   // create a loop $num_post times to populate $post_array
  //   $count = 0;
  //
  //   while($count < $toget) {
  //     // headings
  //     $headings = $html->find("article[itemtype*=CollectionPage] > header > h4");
  //     $heading = $headings[$count]->plaintext;
  //     $posts_array[$site][$count]['heading'] = $heading;
  //     // images
  //     $img_url_attr = 'data-srcset';
  //     $pictures = $html->find("article.article-featured-item > picture > source[media=(min-width: 1024px)]");
  //     // array of two comma delimited attibutes returned from srcset
  //     $images = explode (', ', $pictures[$count]->$img_url_attr);
  //     // extract first attibute
  //     $image =  'https:'.$images[0];
  //     $posts_array[$site][$count]['image'] = $image;
  //     // links
  //     $links = $html->find("article.article-featured-item > a");
  //     $link = $url_short.$links[$count]->href;
  //     $posts_array[$site][$count]['url'] = $link;
  //     $count++;
  //   }
  //   $counter++;
  // }
  //  LUCKY PEACH
  if ($https[$counter]['name'] == 'Lucky Peach') {
    // RETRIEVE PERTINENT VARIABLES FROM ARRAY OF SITE DATA (array: $http)
    $site = $https[$counter]['name'];
    $toget = $https[$counter]['toget'];
    $url_short = $https[$counter]['short'];
    $url_long = $https[$counter]['long'];

    // create storage container path
    $storage_container = "pages/$site.html";

    // Check if created page exists,
    // create one if not, update it if
    // page is older than a day.
    if (file_exists($storage_container)) {
      $age = (time()-filemtime($storage_container));
      if ($age > 60*60*12) {
        // call to ScClass for download_page method
        ScCurl::download_page($url_short, $storage_container);
      }
    } else if (!file_exists($storage_container)) {
      // call to ScClass for download_page method
      ScCurl::download_page($url_short, $storage_container);
    }

    // Create $html object
    $html = file_get_html($storage_container);

    // POPULATE POST_ARRAY
    // create a loop $num_post times to populate $post_array
    $count = 0;

    while($count < $toget) {
      // headings
      $headings = $html->find("div.archive-list--content div.entry-title h2 a");
      $heading = $headings[$count]->plaintext;
      $posts_array[$site][$count]['heading'] = $heading;
      // images
      $pictures = $html->find("div.archive-list--img a img");
      $picture = $pictures[$count]->src;
      $posts_array[$site][$count]['image'] = $picture;
      // links
      $links = $html->find("div.archive-list--content div.entry-title h2 a");
      $link = $links[$count]->href;
      $posts_array[$site][$count]['url'] = $link;
      $count++;
    }
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

    // Check if created page exists,
    // create one if not, update it if
    // page is older than a day.
    if (file_exists($storage_container)) {
      $age = (time()-filemtime($storage_container));
      if ($age > 60*60*12) {
        // call to ScClass for download_page method
        ScCurl::download_page($url_short, $storage_container);
      }
    } else if (!file_exists($storage_container)) {
      // call to ScClass for download_page method
      ScCurl::download_page($url_short, $storage_container);
    }

    // Create $html object
    $html = file_get_html($storage_container);

    // POPULATE POST_ARRAY
    // create a loop $num_post times to populate $post_array
    $count = 0;

    while($count < $toget) {
      // headings
      $headings = $html->find("li.views-row div div div div.pane-node-title h3 a");
      $heading = $headings[$count]->plaintext;
      $posts_array[$site][$count]['heading'] = $heading;
      // images
      $dataSrc = "data-medsrc";
      $pictures = $html->find("li.views-row div div div div.pane-node-field-image div a noscript img");
      $picture = $pictures[$count]->$dataSrc;
      $posts_array[$site][$count]['image'] = $picture;
      // links
      $links = $html->find("li.views-row div div div div.pane-node-title h3 a");
      $link = "$url_short".$links[$count]->href;
      $posts_array[$site][$count]['url'] = $link;
      $count++;
    }
    $counter++;
  }
  // returns JSON data
  //echo json_encode($posts_array);
  // returns populated array
  return $posts_array;

} // end function latest_posts()

// CALL function
latest_posts ($https);

// Display array data
  foreach ($posts_array as $key => $value) {
    echo "<h1>$key</h1>";
    foreach ($value as $key2 => $value2) {
      $img_url = $value2['image'];
      $title = $value2['heading'];
      $href =  $value2['url'];
      ?>
      <a href="<?php echo $href; ?>">
        <img src="<?php echo $img_url; ?>" alt="<?php echo $title; ?>">
      </a>
      <h2><?php echo $title; ?></h2>
      <?php
    }
  }

?>
