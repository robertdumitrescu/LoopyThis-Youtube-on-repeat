<?php
require("classes/database.php");
class Song extends DatabaseQuery
{


    public function __construct()
    {
        $this->siteKey = 'my site key will go here';
    }

    public function AddSongs($data) {

        parent::addSongs($data);

    }

    public function AddSong($url, $title) {

        parent::addSong($url, $title);

    }


}

?>