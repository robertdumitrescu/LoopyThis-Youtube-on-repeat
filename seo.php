<?php
/**
 * Created by PhpStorm.
 * User: idz
 * Date: 3/28/15
 * Time: 11:23 AM
 */


function generateSEO($canonical_link, $base_description, $base_title, $custom_title)
{

    echo "<title>";
    echo $base_title . $custom_title;
    echo "</title>";
    echo "<meta charset=\"utf-8\">";
    echo "<meta name=\"viewport\" content=\"width=device-width\">";
    echo "<meta name=\"description\" content=\"" . $base_description . "\">";
    echo "<link rel=\"canonical\" href=\"" . $canonical_link . "\">";
    echo "<meta property=\"og:locale\" content=\"en_US\">";
    echo "<meta property=\"og:type\" content=\"website\">";
    echo "<meta property=\"og:title\" content=\"" . $base_title . $custom_title . "\">";
    echo "<meta property=\"og:description\" content=\"" . $base_description . "\">";
    echo "<meta property=\"og:url\" content=\"" . $canonical_link . "\">";
    echo "<meta property=\"og:site_name\" content=\"" . $base_title . "\">";
}


?>