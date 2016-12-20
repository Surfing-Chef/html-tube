<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>My Latest Feeds</title>
    <!-- <link rel="stylesheet" type="text/css" href="styles.css"> -->
</head>

<body>
  <h1>My Latest Feeds</h1>

  <div id="main">
    <?php
      include("feeds.php");
    ?>

    <br><br>
    This space is for php generated html and will be visible below php generated content possibly as intended.<br><br>
    Optionally, the button below uses javascript to retrieve replace this data.<br><br>
  </div>

  </br>

  <button id="ajax-button" type="button">Update content with Ajax</button>

  <script>
    function replaceText() {
      var xhr = new XMLHttpRequest();
      var target = document.getElementById("main");
      xhr.open('GET', 'feeds.php', true);
      xhr.onreadystatechange = function (){
        if(xhr.readyState == 2){
          target.innerHTML = 'Loading...';
        }
        if(xhr.readyState == 4 && xhr.status == 200){
          var json = JSON.parse(xhr.responseText);
          //target.innerHTML = (Object.keys(json)) + ' JSON data is loaded.';
          target.innerHTML = "<h2>Data Retreived:</h2>";
          //target.innerHTML = "<pre>" + json + "</pre>";
          target.innerHTML += "<pre>"+JSON.stringify(json, null, '\t')+"</pre>";
          // target.innerHTML = json.Food52[0].image;
        }
      }
      xhr.send();
    }

    var button = document.getElementById ("ajax-button");
    button.addEventListener("click", replaceText);
  </script>

</body>
</html>
