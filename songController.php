<?php
/**
 * Created by PhpStorm.
 * User: idz
 * Date: 4/8/15
 * Time: 10:52 PM
 */

require_once 'classes/song.php';

$songClass = new Song();

$postdata = file_get_contents("php://input");

$request = json_decode($postdata);

//var_dump(count($request->resulting_objects));

if (property_exists($request, "resulting_objects")) {


    $songs_filtered = [];

    $number_of_elements = count($request->resulting_objects);

    for($i = 0; $i < $number_of_elements; $i++) {

        //  var_dump($request->resulting_objects[$i]->title);

        // var_dump($request->resulting_objects[$i]->id);

        $song = [$request->resulting_objects[$i]->id, $request->resulting_objects[$i]->title];

        array_push($songs_filtered, $song);
    };

    $songClass->AddSongs($songs_filtered);


}

/*'http://gdata.youtube.com/feeds/api/videos/'+data[iter]+'?v=2&alt=jsonc'*/
if (property_exists($request, "object")) {


    $video_id = count($request->object);

    $json_output = file_get_contents("http://gdata.youtube.com/feeds/api/videos/" . $video_id . "?v=2&alt=jsonc");
    $json = json_decode($json_output, true);

    // var_dump($json);

}



?>