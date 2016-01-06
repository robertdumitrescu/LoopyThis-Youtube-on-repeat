<!DOCTYPE html>
<html>
 <head>
  <title>Minify JS code</title>
 </head>
 <body>
  <div id="content">
   <h1>Minify JavaScript</h1>
   <p>Paste your JavaScript code in the textbox and click <b>Minify</b></p>
   <form method="POST">
    <textarea name="code" style="width:400px;height:200px;"></textarea><br/>
    <button style="padding:5px 30px;font-size:20px;">Minify</button>
   </form>
   <?php
    require_once "min-js.php";
    $jSqueeze = new JSqueeze();
    echo "<h2>Output</h2>";
   $input = "lala";
    $code = $jSqueeze->squeeze($input, true, false);
    if($code != $input){
     echo '<textarea name="code" style="width:400px;height:200px;">'.$code.'</textarea>';
    }else{
     echo 'There was no need to be minified';
    }

   ?>
  </div>
  <!-- http://subinsb.com/php-minify-js-code -->
 </body>
</html>