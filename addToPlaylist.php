<?php
if(!isset($_SESSION))
{
        session_start();
}

if(isset($_SESSION['id'])) {

        $id= $_SESSION['real_id'];

        $config_file = file_get_contents("config/config.json");
        $config_file_parsed=json_decode($config_file,true);
        include_once("database.php");
        $connection = connect($config_file_parsed["database"]["host"], $config_file_parsed["database"]["user"], $config_file_parsed["database"]["pass"], $config_file_parsed["database"]["database"]);
        $sql='SELECT id,name FROM playlist WHERE id_user=?';
        $stmt = mysqli_prepare($connection,$sql);
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $stmt->bind_result($idPlaylist,$name);


        while ($stmt->fetch()) {
               
                echo '<div class="checkbox"><label><input type="checkbox" class="checkValue" value='."'".$idPlaylist."'>".'<span class="ripple"></span><span class="check"></span><span class="ripple"></span>'.$name.'</label></div>';
                
            }
        }
?>

