<?php
/**
 * Created by PhpStorm.
 * User: robert.dumitrescu
 * Date: 3/27/2015
 * Time: 7:02 PM
 */




// echo "mata";


$config_file = file_get_contents("config/config.json");
$config_file_parsed=json_decode($config_file,true);
include_once("database.php");
$connection = connect($config_file_parsed["database"]["host"], $config_file_parsed["database"]["user"], $config_file_parsed["database"]["pass"], $config_file_parsed["database"]["database"]);
// echo "mata2";

if(isset($_POST['fepid']) && isset($_POST['fesid'])) {
    $fepid = $_POST['fepid'];
    $fesid = $_POST['fesid'];

    // echo($fepid . $fesid);

    $sql = "DELETE FROM song_playlist WHERE id_playlist =" . $fepid . " AND id_song=" . $fesid . ";";
    // echo($sql);
    $stmt = mysqli_prepare($connection,$sql);
    $stmt->execute();




    if(mysqli_affected_rows($connection)==0) {
        $error='Unfortunately this action failed!';
        echo $error;
    }
    else
    {
        echo 'Song deleted succesfully';
    }



}



?>