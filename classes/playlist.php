<?php
require("classes/database.php");
class Playlist extends DatabaseQuery
{

    private $_siteKey;

    private $encryption_key = "abc";

    public function __construct()
    {
        $this->siteKey = 'my site key will go here';
    }

public function AddPlaylist($playlist_name, $encrypted_user_id) {

    $user_id = $this->decode($encrypted_user_id);
    $database_return_code = parent::addDbPlaylist($playlist_name, $user_id);


    return $database_return_code;

}




    public function GetPlaylists($encrypted_user_id) {


        $user_id = $this->decode($encrypted_user_id);
        $playlist_object = parent::GetPlaylists($user_id);
            //var_dump($user_id);
        // var_dump($playlist_object);
        return $playlist_object;

    }


    public function youtube_id_from_url($url) {
        $pattern =
            '%^# Match any youtube URL
            (?:https?://)?  # Optional scheme. Either http or https
            (?:www\.)?      # Optional www subdomain
            (?:             # Group host alternatives
              youtu\.be/    # Either youtu.be,
            | youtube\.com  # or youtube.com
              (?:           # Group path alternatives
                /embed/     # Either /embed/
              | /v/         # or /v/
              | /watch\?v=  # or /watch\?v=
              )             # End path alternatives.
            )               # End host alternatives.
            ([\w-]{10,12})  # Allow 10-12 for 11 char youtube id.
            $%x'
        ;
        $result = preg_match($pattern, $url, $matches);
        if (false !== $result) {
            return $matches[1];
        }
        return false;
    }

    public function GetPlaylistsForAssoc($encrypted_user_id, $songCodeWithUrl) {


        $user_id = $this->decode($encrypted_user_id);
        $songCode = $this->youtube_id_from_url($songCodeWithUrl);
        $playlist_assoc_object = parent::GetPlaylistsForAssoc($user_id, $songCode);
        //var_dump($user_id);
        //var_dump($playlist_object);
        return $playlist_assoc_object;

    }


    public function UpdatePlaylistsForAssoc($encrypted_user_id, $songCodeWithUrl, $playlists_obj_updated) {






        $user_id = $this->decode($encrypted_user_id);
        $songCode = $this->youtube_id_from_url($songCodeWithUrl);

        $json_output = file_get_contents("http://gdata.youtube.com/feeds/api/videos/" . $songCode . "?v=2&alt=jsonc");
        $json = json_decode($json_output, true);
        $songName = $json["data"]["title"];


        $playlist_assoc_object = parent::UpdatePlaylistsForAssoc($user_id, $songCode, $songName, $playlists_obj_updated);
        //var_dump($user_id);
        // var_dump($playlists_obj_updated);

         return $playlist_assoc_object;

    }




    public function DeletePlaylist() {




    }

    public function DeleteSongFromPlaylist($encrypted_user_id, $songCode, $playlistId) {


        $user_id = $this->decode($encrypted_user_id);
        $song_code = $songCode;
        $playlist_id = $playlistId;


        $db_response_for_song_deletion = parent::DeleteSongFromPlaylist($user_id, $song_code, $playlist_id);
        //var_dump($user_id);
        // var_dump($playlists_obj_updated);

        return $db_response_for_song_deletion;


    }


    public  function safe_b64encode($string) {

        $data = base64_encode($string);
        $data = str_replace(array('+','/','='),array('-','_',''),$data);
        return $data;
    }

    public function safe_b64decode($string) {
        $data = str_replace(array('-','_'),array('+','/'),$string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
    }


    public function encode($data){

        if(!$data){return false;}
        $text = $data;
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->siteKey, $text, MCRYPT_MODE_ECB, $iv);
        return trim($this->safe_b64encode($crypttext));

    }

    public function decode($encrypted_data){

        if(!$encrypted_data){return false;}
        $crypttext = $this->safe_b64decode($encrypted_data);
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->siteKey, $crypttext, MCRYPT_MODE_ECB, $iv);
        return trim($decrypttext);

    }


}

?>