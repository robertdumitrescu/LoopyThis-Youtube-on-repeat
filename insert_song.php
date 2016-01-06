<?php
if(!isset($_SESSION))
{
    session_start();
}

if(isset($_POST['values'])&&isset($_POST['song_url'])&&isset($_SESSION['id'])&&isset($_POST['song_name'])) {

    //database configuration
    $config_file = file_get_contents("config/config.json");
    $config_file_parsed=json_decode($config_file,true);
    include_once("database.php");
    $connection = connect($config_file_parsed["database"]["host"], $config_file_parsed["database"]["user"], $config_file_parsed["database"]["pass"], $config_file_parsed["database"]["database"]);

    //sql injection protection
    $id=mysqli_real_escape_string($connection,$_SESSION['real_id']);
    $song_name=mysqli_real_escape_string($connection,$_POST['song_name']);
    $song_url=mysqli_real_escape_string($connection,$_POST['song_url']);

    //
    $playListIds=$_POST['values'];

    for($i=0;$i<count($playListIds);$i++) {
        filter_var($playListIds[$i], FILTER_SANITIZE_NUMBER_INT);
        $playListIds[$i]=mysqli_real_escape_string($connection,$playListIds[$i]);
        }

       if(strlen($song_name)>3&&strlen($song_url)>3) {
           $howMany=mysqli_query($connection,'SELECT COUNT(name) as howMany FROM songs WHERE url ="'.$song_url.'"');
       if(mysqli_fetch_array($howMany)['howMany']==0) {

          $sql='INSERT INTO songs(id,name,url) VALUES(NULL,?,?)';
          $stmt = mysqli_prepare($connection,$sql);
          $stmt->bind_param("ss", $song_name,$song_url);
          $stmt->execute();

       if(mysqli_affected_rows($connection)==0) {
         $error='Unfortunately this action failed!';
         echo $error;
         return 0;
       }
       else
       {
        $result=mysqli_query($connection,'SELECT id FROM songs WHERE url ="'.$song_url.'"');
        $idOfSong=mysqli_fetch_array($result)['id'];
        $sql="INSERT INTO song_playlist(id,id_playlist,id_song) VALUES";
        $contor=0;

        for($i=0;$i<count($playListIds)-1;$i++)
        {
            $result=mysqli_query($connection,'SELECT COUNT(id) as contor FROM song_playlist WHERE id_song ="'.$idOfSong.'" AND id_playlist="'.$playListIds[$i].'"');
            if(mysqli_fetch_array($result)['contor']==0)
            $sql.="(NULL,"."'".$playListIds[$i]."',"."'".$idOfSong."'),";
            else $contor++;
        }
       $result=mysqli_query($connection,'SELECT COUNT(id) as contor FROM song_playlist WHERE id_song ="'.$idOfSong.'" AND id_playlist="'.$playListIds[$i].'"');
            if(mysqli_fetch_array($result)['contor']==0)
            $sql.="(NULL,"."'".$playListIds[$i]."',"."'".$idOfSong."');";
            else {
            $contor++;
            $sql=substr($sql, 0, -1);
            $sql.=";";
            }

            if($contor==0)
            mysqli_query($connection,$sql);
            if(mysqli_affected_rows($connection)>0&&$contor==0) {

        echo 'Song added to playlist/playlists!'; }
        else
        {
          echo 'An error appeared or song already exists in playlist!';
        }
       }}
       else {

        $result=mysqli_query($connection,'SELECT id FROM songs WHERE url ="'.$song_url.'"');
        $idOfSong=mysqli_fetch_array($result)['id'];



        $sql="INSERT INTO song_playlist(id,id_playlist,id_song) VALUES";
        $contor=0;
        for($i=0;$i<count($playListIds)-1;$i++)
        {
            $result=mysqli_query($connection,'SELECT COUNT(id) as contor FROM song_playlist WHERE id_song ="'.$idOfSong.'" AND id_playlist="'.$playListIds[$i].'"');
            if(mysqli_fetch_array($result)['contor']==0)
            $sql.="(NULL,"."'".$playListIds[$i]."',"."'".$idOfSong."'),";
            else $contor++;
        }
            $result=mysqli_query($connection,'SELECT COUNT(id) as contor FROM song_playlist WHERE id_song ="'.$idOfSong.'" AND id_playlist="'.$playListIds[$i].'"');
            if(mysqli_fetch_array($result)['contor']==0)
            $sql.="(NULL,"."'".$playListIds[$i]."',"."'".$idOfSong."');";
            else {
            $contor++;
            $sql=substr($sql, 0, -1);
            $sql.=";";
            }

            if($contor==0)
            mysqli_query($connection,$sql);
            if(mysqli_affected_rows($connection)>0&&$contor==0) {

        echo 'Song added to playlist/playlists!'; }
        else
        {
          echo 'An error appeared or song already exists in playlist!';
        }
      }
}}

?>