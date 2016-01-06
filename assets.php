<?php
/**
 * Created by PhpStorm.
 * User: idz
 * Date: 3/27/15
 * Time: 11:37 PM
 */




$env = "prod";
/*

http://www.loopythis.com/assets/jquery/jquery.min.js
http://www.loopythis.com/public/js/snack.js
//fezvrasta.github.io/snackbarjs/dist/snackbar.min.js
http://www.loopythis.com/assets/jquery-ui/jquery-ui.min.js
http://www.loopythis.com/assets/bootstrap/js/bootstrap.min.js
http://www.loopythis.com/assets/bootstrap-material/js/ripples.min.js
http://www.loopythis.com/assets/bootstrap-material/js/material.min.js


*/
/*

    http://www.loopythis.com/assets/bootstrap/css/bootstrap.min.css
    http://www.loopythis.com/assets/bootstrap-material/css/ripples.min.css
    http://www.loopythis.com/assets/bootstrap-material/css/material-wfont.min.css
    http://www.loopythis.com/public/css/main.css
    http://www.loopythis.com/public/css/skins.css
    http://www.loopythis.com/public/css/animate.css
    http://www.loopythis.com/assets/font-awesome/css/font-awesome.min.css
    http://www.loopythis.com/assets/simple-sidebar/css/simple-sidebar.css

*/

?>


<?php

if ($env == "prod") {

?>


    <script src="public/allJS.min.js"></script>
    <script src="//fezvrasta.github.io/snackbarjs/dist/snackbar.min.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css" />
    <link href="//fezvrasta.github.io/snackbarjs/dist/snackbar.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
    <link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <link href="public/allCSS.css" rel="stylesheet">


<?php
} else {
?>









    <script src="//fezvrasta.github.io/snackbarjs/dist/snackbar.min.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css" />
    <link href="//fezvrasta.github.io/snackbarjs/dist/snackbar.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
    <link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>

    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/bootstrap-material/js/ripples.min.js"></script>
    <script src="assets/bootstrap-material/js/material.min.js"></script>

    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/bootstrap-material/css/ripples.min.css" rel="stylesheet">
    <link href="assets/bootstrap-material/css/material-wfont.min.css" rel="stylesheet">
    <link href="public/css/main.css" rel="stylesheet">
    <link href="public/css/skins.css" rel="stylesheet">
    <link href="public/css/animate.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
    <link href="assets/simple-sidebar/css/simple-sidebar.css" rel="stylesheet">

<?php
}
    ?>