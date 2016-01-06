<?php


class DatabaseQuery
{

    public $database_host = "localhost";
    public $database_name = "youtube";
    public $database_user = "youtube_u";
    public $database_password = "192837";


    public function addSongs($data)
    {

        $dbhost = $this->database_host;
        $dbname = $this->database_name;
        $dbuser = $this->database_user;
        $dbpass = $this->database_password;


        $dataLength = count($data);

        for ($i = 0; $i < $dataLength; $i++) {


            $login_connection_select = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);

            $songs_select_sql = 'SELECT url
            FROM lt_songs
            WHERE url LIKE :url';

            $songs_select_query = $login_connection_select->prepare($songs_select_sql);
            $songs_select_query->execute(array(':url' => $data[$i][0]));
            $songs_select_query->setFetchMode(PDO::FETCH_ASSOC);

            $songs_select_result = $songs_select_query->fetch();

            if (gettype($songs_select_result) == "boolean" || empty($songs_select_result)) {

                $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);

                $sql = "INSERT INTO lt_songs (name, url) VALUES (:name,:url)";

                $q = $conn->prepare($sql);
                $q->execute(array(
                    ':name' => $data[$i][1],
                    ':url' => $data[$i][0]
                ));

            } else {

            }

        }
        return true;
    }


    public function GetPlaylists($user_id)
    {

        $playlists_object = [];

        $dbhost = $this->database_host;
        $dbname = $this->database_name;
        $dbuser = $this->database_user;
        $dbpass = $this->database_password;

        /*        try {*/
        // echo $user_id;
        $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);

        $sql = 'SELECT *
            FROM lt_playlists
            WHERE lt_playlists_user_id LIKE :lt_playlists_user_id';

        $sql2 = 'SELECT *
            FROM lt_song_playlist
            WHERE ltsp_playlist_id LIKE :ltsp_playlist_id';

        $query = $conn->prepare($sql);
        $query->execute(array(':lt_playlists_user_id' => $user_id));
        $query->setFetchMode(PDO::FETCH_ASSOC);


        while ($playlists = $query->fetch()) {
            $playlists["songs"] = [];
            $query2 = $conn->prepare($sql2);
            $query2->execute(array(':ltsp_playlist_id' => $playlists["lt_playlists_id"]));
            $query2->setFetchMode(PDO::FETCH_ASSOC);

            while ($songs = $query2->fetch()) {


                array_push($playlists["songs"], $songs);
            }


            array_push($playlists_object, $playlists);


        };


        return $playlists_object;
    }


    public function DeleteSongFromPlaylist($user_id, $song_code, $playlist_id)
    {

        $dbhost = $this->database_host;
        $dbname = $this->database_name;
        $dbuser = $this->database_user;
        $dbpass = $this->database_password;


        $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);

        $sql = "DELETE FROM lt_song_playlist WHERE ltsp_song_id LIKE :ltsp_song_id AND ltsp_playlist_id LIKE :ltsp_playlist_id AND ltsp_user_id LIKE :user_id LIMIT 1";

        $query = $conn->prepare($sql);
        $query->execute(array(
            ':ltsp_song_id' => $song_code,
            'ltsp_playlist_id' => $playlist_id,
            'user_id' => $user_id

        ));
        $query->setFetchMode(PDO::FETCH_ASSOC);


        return 1;


    }


    public function GetPlaylistsForAssoc($user_id, $song_token)
    {

        $playlists_assoc_object = [];

        $dbhost = $this->database_host;
        $dbname = $this->database_name;
        $dbuser = $this->database_user;
        $dbpass = $this->database_password;

        /*        try {*/
        // echo $user_id;
        $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);

        $sql = 'SELECT lt_playlists_id, lt_playlists_name
            FROM lt_playlists
            WHERE lt_playlists_user_id LIKE :lt_playlists_user_id';

        $query = $conn->prepare($sql);
        $query->execute(array(':lt_playlists_user_id' => $user_id));
        $query->setFetchMode(PDO::FETCH_ASSOC);


        while ($playlists = $query->fetch()) {

            $conn2 = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);

            $sql2 = 'SELECT *
            FROM lt_song_playlist
            WHERE ltsp_playlist_id LIKE :ltsp_playlist_id AND ltsp_song_id LIKE :ltsp_song_id';
            $playlists['assoc_on'] = false;
            $query2 = $conn2->prepare($sql2);
            $query2->execute(array(':ltsp_playlist_id' => $playlists['lt_playlists_id'], ':ltsp_song_id' => $song_token));
            $query2->setFetchMode(PDO::FETCH_ASSOC);

            while ($associations = $query2->fetch()) {

                if (!empty($associations)) {
                    $playlists['assoc_on'] = true;
                }
                // var_dump($associations);


            }


            array_push($playlists_assoc_object, $playlists);


        };


        return $playlists_assoc_object;
    }


    public function UpdatePlaylistsForAssoc($user_id, $songCode, $songName, $playlists_obj_updated)
    {

        $dbhost = $this->database_host;
        $dbname = $this->database_name;
        $dbuser = $this->database_user;
        $dbpass = $this->database_password;

        $playlists_obj_updated_count = count($playlists_obj_updated);

        $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
        $sql0 = 'SELECT count(*)
            FROM lt_song_playlist
            WHERE ltsp_playlist_id LIKE :ltsp_playlist_id AND ltsp_song_id LIKE :ltsp_song_id';
        $sql1 = "INSERT INTO lt_song_playlist (ltsp_song_id, ltsp_song_name, ltsp_playlist_id, ltsp_user_id) VALUES (:ltsp_song_id, :ltsp_song_name, :ltsp_playlist_id, :ltsp_user_id)";
        $sql2 = "DELETE FROM lt_song_playlist WHERE ltsp_song_id LIKE :ltsp_song_id AND ltsp_playlist_id LIKE :ltsp_playlist_id";
        $sql3 = "DELETE FROM lt_song_playlist WHERE ltsp_song_id LIKE :ltsp_song_id AND ltsp_playlist_id LIKE :ltsp_playlist_id LIMIT :song_playlist_limit";
        for ($i = 0; $i < $playlists_obj_updated_count; $i++) {

            // var_dump($playlists_obj_updated_count[$i]);

            if ($playlists_obj_updated[$i]->assoc_on == true) {


                $q0 = $conn->prepare($sql0);
                $q0->execute(array(
                    ':ltsp_song_id' => $songCode,
                    ':ltsp_playlist_id' => $playlists_obj_updated[$i]->lt_playlists_id
                ));
                $q0->setFetchMode(PDO::FETCH_ASSOC);

                $count_rows = $q0->fetchColumn();
                $count_rows_limit = $count_rows - 1;


                // var_dump($json);

                if ($count_rows == 0) {
                    $q1 = $conn->prepare($sql1);
                    $q1->execute(array(
                        ':ltsp_song_id' => $songCode,
                        ':ltsp_playlist_id' => $playlists_obj_updated[$i]->lt_playlists_id,
                        ':ltsp_song_name' => $songName,
                        ':ltsp_user_id' => $user_id
                    ));
                } else if ($count_rows > 1) {

                    $q3 = $conn->prepare($sql3);
                    $q3->execute(array(
                        ':ltsp_song_id' => $songCode,
                        ':ltsp_playlist_id' => $playlists_obj_updated[$i]->lt_playlists_id,
                        ':song_playlist_limit' => $count_rows_limit
                    ));

                } else {

                }


            } else {


                $q2 = $conn->prepare($sql2);
                $q2->execute(array(
                    ':ltsp_song_id' => $songCode,
                    ':ltsp_playlist_id' => $playlists_obj_updated[$i]->lt_playlists_id
                ));


            }

        }


        //   $sql = "INSERT INTO lt_playlists (lt_playlists_user_id, lt_playlists_name) VALUES (:lt_playlists_user_id,:lt_playlists_name)";

        /*
                try {

                    $q = $conn->prepare($sql);
                    $q->execute(array(
                        ':lt_playlists_user_id' => $user_id,
                        ':lt_playlists_name' => $playlistName
                    ));

                    return true;

                } catch (PDOException $e) {
                    echo $e->getMessage();
                    return false;
                }*/
        return true;
    }


    public function addDbPlaylist($playlistName, $user_id)
    {

        $dbhost = $this->database_host;
        $dbname = $this->database_name;
        $dbuser = $this->database_user;
        $dbpass = $this->database_password;

        $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);

        $sql = "INSERT INTO lt_playlists (lt_playlists_user_id, lt_playlists_name) VALUES (:lt_playlists_user_id,:lt_playlists_name)";


        try {

            $q = $conn->prepare($sql);
            $q->execute(array(
                ':lt_playlists_user_id' => $user_id,
                ':lt_playlists_name' => $playlistName
            ));

            return 1;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return 2;
        }

    }

    public function insertLoginSession($user_id, $session_id, $token, $user_agent)
    {


        $dbhost = $this->database_host;
        $dbname = $this->database_name;
        $dbuser = $this->database_user;
        $dbpass = $this->database_password;

        $login_connection_insert = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);

        $login_connection_insert_sql = "INSERT INTO lt_logged_in (user_id, session_id, token, user_agent) VALUES (:user_id,:session_id,:token,:user_agent)";


        $login_connection_insert_query = $login_connection_insert->prepare($login_connection_insert_sql);
        $login_connection_insert_query->execute(array(
            ':user_id' => $user_id,
            ':session_id' => $session_id,
            ':token' => $token,
            ':user_agent' => $user_agent
        ));

        return true;

    }


    public function findUserForLogin($email)
    {


        $dbhost = $this->database_host;
        $dbname = $this->database_name;
        $dbuser = $this->database_user;
        $dbpass = $this->database_password;

        $login_connection_select = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);

        $login_connection_select_sql = 'SELECT *
            FROM lt_users
            WHERE email LIKE :email';

        $login_connection_select_query = $login_connection_select->prepare($login_connection_select_sql);
        $login_connection_select_query->execute(array(':email' => $email));
        $login_connection_select_query->setFetchMode(PDO::FETCH_ASSOC);

        $login_connection_select_result = $login_connection_select_query->fetch();

        return $login_connection_select_result;


    }


    public function storeTrackData($lt_trk_client_ip, $lt_trk_x_forward, $lt_trk_remote_adress, $lt_trk_user_agent, $lt_trk_country_name, $lt_trk_city_name, $lt_trk_time_zone, $lt_trk_timestamp, $lt_trk_gmt)
    {


        $dbhost = $this->database_host;
        $dbname = $this->database_name;
        $dbuser = $this->database_user;
        $dbpass = $this->database_password;


        $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);

        $sql = "INSERT INTO lt_tracking (lt_trk_client_ip, lt_trk_x_forward, lt_trk_remote_adress, lt_trk_user_agent, lt_trk_country_name, lt_trk_city_name, lt_trk_time_zone, lt_trk_timestamp, lt_trk_gmt) VALUES (:lt_trk_client_ip, :lt_trk_x_forward, :lt_trk_remote_adress, :lt_trk_user_agent, :lt_trk_country_name, :lt_trk_city_name, :lt_trk_time_zone, :lt_trk_timestamp, :lt_trk_gmt)";


        try {

            $q = $conn->prepare($sql);
            $q->execute(array(
                ':lt_trk_client_ip' => $lt_trk_client_ip,
                ':lt_trk_x_forward' => $lt_trk_x_forward,
                ':lt_trk_remote_adress' => $lt_trk_remote_adress,
                ':lt_trk_user_agent' => $lt_trk_user_agent,
                ':lt_trk_country_name' => $lt_trk_country_name,
                ':lt_trk_city_name' => $lt_trk_city_name,
                ':lt_trk_time_zone' => $lt_trk_time_zone,
                ':lt_trk_timestamp' => $lt_trk_timestamp,
                ':lt_trk_gmt' => $lt_trk_gmt
            ));

            return true;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }


    }


    public function addUserToDb($email, $password, $user_salt, $verification_code)
    {


        $dbhost = $this->database_host;
        $dbname = $this->database_name;
        $dbuser = $this->database_user;
        $dbpass = $this->database_password;


        $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);

        $sql = "INSERT INTO lt_users (email, password, user_salt, verification_code) VALUES (:email,:password,:user_salt,:verification_code)";


        try {

            $q = $conn->prepare($sql);
            $q->execute(array(
                ':email' => $email,
                ':password' => $password,
                ':user_salt' => $user_salt,
                ':verification_code' => $verification_code
            ));

            return true;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }


    }


    public function fetchDbUserData($user_id)
    {

        $dbhost = $this->database_host;
        $dbname = $this->database_name;
        $dbuser = $this->database_user;
        $dbpass = $this->database_password;

        /*        try {*/
        $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);

        $sql = 'SELECT *
            FROM lt_users
            WHERE id LIKE :user_id LIMIT 1';

        $query = $conn->prepare($sql);
        $query->execute(array(':user_id' => $user_id));
        $query->setFetchMode(PDO::FETCH_ASSOC);


        while ($result = $query->fetch()) {

            echo $result['id'];


        }

    }

    public function fetchDbPlaylist($user_id)
    {


    }

}
