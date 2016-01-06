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
                        
                        $k=0;
                        $keyValue=array();
                        while ($stmt->fetch()) {
                            $keyValue[$idPlaylist]=$name;
                        }
  
                        foreach($keyValue as $idPlaylist=>$name)
                        {
                            
                    
                    echo '<div class="panel panel-default custom-panel-default"><div class="skin-1-playlist-title panel-heading custom-panel-heading" role="tab" id="headingOne">';
                    echo '<div class="mata"><h4 class="panel-title custom-panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#plylst'. $idPlaylist .'" aria-expanded="true" aria-controls="plylst'. $idPlaylist .'">';
                    echo $name;   
                    echo '</a></h4></div><a class="deletePlaylistClass" href="javascript:void(0)" data-feTkn="" data-fepId="' . $idPlaylist . '"><i class="fa fa-times"></i></a></div><div id="plylst' . $idPlaylist . '" class="panel-collapse collapse skin-1-collapsed-playlist" role="tabpanel" aria-labelledby="headingOne">';
                    echo '<div class="panel-body custom-panel-body">';
                    echo '<ul id="playListList">';
                
                        $config_file = file_get_contents("config/config.json");
                        $config_file_parsed=json_decode($config_file,true);
                        include_once("database.php");
                        $connection = connect($config_file_parsed["database"]["host"], $config_file_parsed["database"]["user"], $config_file_parsed["database"]["pass"], $config_file_parsed["database"]["database"]);
                     
                        $sql="SELECT songs.name,songs.url,songs.id FROM song_playlist INNER JOIN songs ON song_playlist.id_song=songs.id WHERE song_playlist.id_playlist=?";
                         $stmt2 = mysqli_prepare($connection,$sql);
                         $stmt2->bind_param('i',$idPlaylist);
                         $stmt2->execute();
                         $stmt2->bind_result($songName,$songUrl, $songId);
                         while ($stmt2->fetch()) {
                            $k++;
                        echo "<input type='hidden' value='".$songUrl."' id=song_".$k." class='hiddenSong'>";
                       //echo "<option value='".$songUrl."'>".$songName."</option>";
                       echo "<li class='PlaylistSong' value='".$songUrl."'"."><div class=\"row song-playlist-item\"><div class=\"col-lg-10\"><i class=\"playlist-play-icon fa fa-play song-title-icon\" style=\"float:left\"></i> <div class=\"song-title-wrapper\"><span class=\"PlaylistSongName\">".$songName ."</span></div></div><div class=\"col-lg-2\"><a class=\"deletePlaylistSong song-delete-item\" href=\"javascript:void(0)\" data-fepId=\"" . $idPlaylist . "\" data-fesId=\"" . $songId . "\"><i class=\"fa fa-times\"></i></a></div></div></li>";
                    }

                    ?>
                    </ul>

                </div>
            </div>
        </div>
        <?php    }}?>