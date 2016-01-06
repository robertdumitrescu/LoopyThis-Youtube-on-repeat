<?php
/**
 * Created by PhpStorm.
 * User: idz
 * Date: 4/6/15
 * Time: 12:19 AM
 */


require_once 'classes/playlist.php';

// session_start();

$playlist = new Playlist();

$postdata = file_get_contents("php://input");

$request = json_decode($postdata);



if (property_exists($request, "playlistName") && property_exists($request, "athTokenPl")) {


    $playlistName = $request->playlistName;
    $encrypted_user_id = $request->athTokenPl;






    $return_code = $playlist->AddPlaylist($playlistName, $encrypted_user_id);


    if ($return_code == 1) {

    echo "Playlist added successfully";

    } else if ($return_code == 2) {

        echo "Something went wrong in database";

    } else {

        echo "Something's wrong";

    }

}

if (property_exists($request, "athTokenPlModel")) {


    $encrypted_user_id = $request->athTokenPlModel;






    $playlist_object = $playlist->GetPlaylists($encrypted_user_id);


echo(json_encode($playlist_object));

}

if (property_exists($request, "athTokenPlOptModel") && property_exists($request, "songCode")) {


    $encrypted_user_id = $request->athTokenPlOptModel;
    $songCode = $request->songCode;






    $playlist_object = $playlist->GetPlaylistsForAssoc($encrypted_user_id, $songCode);

    // echo(json_encode($playlist_object));

    echo(json_encode($playlist_object));

}


if (property_exists($request, "athTokenPlOptUpModel") && property_exists($request, "songCode") && property_exists($request, "playlists_obj_updated")) {


    $encrypted_user_id = $request->athTokenPlOptUpModel;
    $songCode = $request->songCode;
    $playlists_obj_updated = $request->playlists_obj_updated;






    $playlist_object = $playlist->UpdatePlaylistsForAssoc($encrypted_user_id, $songCode, $playlists_obj_updated);

    // echo(json_encode($playlist_object));

    // echo(json_encode($playlist_object));

}

if (property_exists($request, "athTokenDlSngFrmPl") && property_exists($request, "playlistId") && property_exists($request, "songCode")) {


    $playlistId = $request->playlistId;
    $songCode = $request->songCode;
    $encrypted_user_id = $request->athTokenDlSngFrmPl;



    $playlist_object = $playlist->DeleteSongFromPlaylist($encrypted_user_id, $songCode, $playlistId);

    if ($playlist_object == 1) {

        echo "Song deleted successfully";

    } else {

        echo "There was a problem deleting your song";
    }

//echo $playlistId;
 //   echo $songCode;





}

?>