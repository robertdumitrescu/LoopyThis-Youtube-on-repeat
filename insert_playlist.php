<?php
if(!isset($_SESSION))
{
    session_start();
}
if(isset($_SESSION['id'])&&isset($_POST['name'])) {
    $text=$_POST['name'];
    $id=$_SESSION['real_id'];

$config_file = file_get_contents("config/config.json");
$config_file_parsed=json_decode($config_file,true);
include_once("database.php");
$connection = connect($config_file_parsed["database"]["host"], $config_file_parsed["database"]["user"], $config_file_parsed["database"]["pass"], $config_file_parsed["database"]["database"]);
$text=mysqli_real_escape_string($connection,trim($text));
if(strlen($text)<3) {
	echo 'Playlist name should be at least 3 characters long!';
}
else {

$sql='SELECT * FROM playlist WHERE name=? AND id_user=?';
$stmt = mysqli_prepare($connection,$sql);
$stmt->bind_param("si",$text,$id);
$stmt->execute();
$k=0;
while ($stmt->fetch()) {
        $k++;
        }
if($k>0) {
	echo "Playlist name already exists!";
}
else {

$sql='INSERT INTO playlist(id,id_user,name) VALUES(NULL,?,?)';
$stmt = mysqli_prepare($connection,$sql);
$stmt->bind_param("is", $id,$text);
$stmt->execute();
       if(mysqli_affected_rows($connection)==0) {
         $error='Unfortunately this action failed!';
         echo $error;
       }
       else
       {
       	echo 'New playlist created!';
       }

}}}
?>
