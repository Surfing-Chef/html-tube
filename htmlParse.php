<?php
// http://simplehtmldom.sourceforge.net/manual.htm

/* REFERENCES

DOM OBJECTS
www.epicurious.com/recipes-menus
www.epicurious.com/expert-advice
www.epicurious.com/ingredients

PAGES
www.epicurious.com/recipes
www.epicurious.com/expert-advice
www.epicurious.com/ingredients

*/


// INCLUDE simple_html_dom.php
include("simple_html_dom.php");

function latest_epicurious ($type){
  // DEFINITIONS
  // webpage
  $web_page = "http://www.epicurious.com";
  // recipes
  $rec_dom = "http://www.epicurious.com/recipes-menus";
  // ingredient
  $ing_dom = "http://www.epicurious.com/ingredients";
  // ingredient
  $xprt_dom = "http://www.epicurious.com/expert-advice";
  // post array
  $post_array = array();
  global $post_array;



  // POPULATE POST_ARRAY
  if ($type == "recipe"){
    $dom = $rec_dom;
    $article = 'article.recipe-of-the-day';

    // Create $html object
    $html = file_get_html($dom);

    // Target image
    $picture = $html->find("'$article' picture source, 1")[0];
    $raw_src = $picture->srcset;
    $src_array = explode(",", $raw_src);
    $src = 'http:'.$src_array[0];
    $post_array["image"] = $src;

    // Target heading
    $heading = $html->find("'$article' div.content a.recipe-hed")[0];
    $heading_txt = $heading->title;
    $post_array["heading"] = $heading_txt;

    // Target summary
    $summary = $html->find("'$article' div.content p")[0];
    $summary_txt = $summary->plaintext;
    $post_array["summary"] = $summary_txt;

    // Target link
    $link = $html->find("'$article' div.content a")[0];
    $href = $web_page.$link->href;
    $post_array["link"] = $href;

  } elseif ($type == "ingredient"){
    $dom = $ing_dom;
    $article = 'article.article-large-hero-featured-item';

    // Create $html object
    $html = file_get_html($dom);

    // Target image
    $picture = $html->find("'$article' picture source, 1")[0];
    $raw_src = $picture->srcset;
    $src_array = explode(",", $raw_src);
    $src = 'http:'.$src_array[0];
    $post_array["image"] = $src;

    // Target heading
    $heading = $html->find("'$article' header.summary h4")[0];
    $heading_txt = $heading->plaintext;
    $post_array["heading"] = $heading_txt;

    // Target link
    $link = $html->find("'$article' a.view-complete-item")[0];
    $href = $web_page.$link->href;
    $post_array["link"] = $href;

    // Target summary
    $summary_html = file_get_html($href);
    $summary_container = $summary_html->find('article.large-hero-article div.large-hero-article div.byline-dek div.dek p')[0];
    $summary_txt = $summary_container->plaintext;
    $post_array["summary"] = $summary_txt;

  } elseif ($type == "expert"){
    $dom = $xprt_dom;
    $article = 'article.article-large-hero-featured-item';

    // Create $html object
    $html = file_get_html($dom);

    // Target image
    $picture = $html->find("'$article' picture source, 1")[0];
    $raw_src = $picture->srcset;
    $src_array = explode(",", $raw_src);
    $src = 'http:'.$src_array[0];
    $post_array["image"] = $src;

    // Target heading
    $heading = $html->find("'$article' header.summary h4")[0];
    $heading_txt = $heading->plaintext;
    $post_array["heading"] = $heading_txt;

    // Target link
    $link = $html->find("'$article' a.view-complete-item")[0];
    $href = $web_page.$link->href;
    $post_array["link"] = $href;

    // Target summary
    $summary_html = file_get_html($href);
    $summary_container = $summary_html->find('article.large-hero-article div.large-hero-article div.byline-dek div.dek p')[0];
    $summary_txt = $summary_container->plaintext;
    $post_array["summary"] = $summary_txt;
  }

  // DISPLAY RESULTS
  $image = $post_array['image'];
  $heading = $post_array['heading'];
  $summary = $post_array['summary'];
  $link = $post_array['link'];
  echo "<img src='$image' />";
  echo "<a target='_blank' href='$link'><h3>$heading</h3></a>";
  echo "<p>$summary</p>";
  echo "</br>"."</br>";
}

//latest_epicurious('recipe');
//latest_epicurious('ingredient');
//latest_epicurious('expert');

?>
