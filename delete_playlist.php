<?php
/**
 * Created by PhpStorm.
 * User: robert.dumitrescu
 * Date: 3/27/2015
 * Time: 6:12 PM
 */



$config_file = file_get_contents("config/config.json");
$config_file_parsed=json_decode($config_file,true);
include_once("database.php");
$connection = connect($config_file_parsed["database"]["host"], $config_file_parsed["database"]["user"], $config_file_parsed["database"]["pass"], $config_file_parsed["database"]["database"]);


if(isset($_POST['fepid'])) {
    $fepid = $_POST['fepid'];






    $sql = "DELETE FROM playlist WHERE id =" . $fepid . ";";
    $stmt = mysqli_prepare($connection,$sql);
    $stmt->execute();




    if(mysqli_affected_rows($connection)==0) {
        $error='Unfortunately this action failed!';
        echo $error;
    }
    else
    {
        echo 'Playlist deleted succesfully';
    }










}


?>


