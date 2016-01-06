<?php
function compress ($code) {
    $code = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $code);
    $code = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $code);
    $code = str_replace('{ ', '{', $code);
    $code = str_replace(' }', '}', $code);
    $code = str_replace('; ', ';', $code);

    return $code;
}


// CSS

$css1 = file_get_contents("assets/bootstrap/css/bootstrap.min.css");
$css2 = file_get_contents("assets/bootstrap-material/css/ripples.min.css");
$css3 = file_get_contents("assets/bootstrap-material/css/material-wfont.min.css");
$css4 = file_get_contents("public/css/main.css");
$css5 = file_get_contents("public/css/skins.css");
$css6 = file_get_contents("public/css/animate.css");
$css8 = file_get_contents("assets/simple-sidebar/css/simple-sidebar.css");


$all_css = $css1.$css2.$css3.$css4.$css5.$css6.$css8;

$all_css_minified = compress ($all_css);

// echo($all_css_minified);

$myfile = fopen("public/allCSS.css", "w") or die("Unable to open file!");
fwrite($myfile, $all_css_minified);



// JS


$js1 = file_get_contents("assets/jquery/jquery.min.js");
$js2 = file_get_contents("public/js/snack.js");
$js3 = file_get_contents("assets/jquery-ui/jquery-ui.min.js");
$js4 = file_get_contents("assets/bootstrap/js/bootstrap.min.js");
$js5 = file_get_contents("assets/bootstrap-material/js/ripples.min.js");
$js6 = file_get_contents("assets/bootstrap-material/js/material.min.js");
/*$js4 = " ";
$js5 = " ";
$js6 = " ";*/
$semicolon = "\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n";

$all_js = $js1.$semicolon.$js2.$semicolon.$js3.$semicolon.$js4.$semicolon.$js5.$semicolon.$js6;

require_once "min-js.php";
$jSqueeze = new JSqueeze();
$all_js_minified = $jSqueeze->squeeze($all_js, true, false);


$myfile = fopen("public/allJS.min.js", "w") or die("Unable to open file!");
fwrite($myfile, $all_js);


?>



<script>
<?php
echo $all_js;
?>
</script>