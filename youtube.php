<?php  

if(isset($_POST['name'])) {
    $text=$_POST['name'];
      // Call set_include_path() as needed to point to your client library.  
  require_once ('google-api-php-client/src/Google_Client.php');  
  require_once ('google-api-php-client/src/contrib/Google_YouTubeService.php');  
  $DEVELOPER_KEY = 'AIzaSyCwfiYOUJSg-ch4xjNm3yNUHROgLND-Hkw';  
  $client = new Google_Client();  
  $client->setDeveloperKey($DEVELOPER_KEY);   
  $youtube = new Google_YoutubeService($client);  
  
  try {  
    $searchResponse = $youtube->search->listSearch('id,snippet', array(  
      'q' => $text,  
      'maxResults' => 11,  
    ));
    $videos = '';  
    $channels = '';  
    $arrayOfVideos=array();
    $k=0;
    foreach ($searchResponse['items'] as $searchResult) {  
      switch ($searchResult['id']['kind']) {  
        case 'youtube#video':  
//          $videos .= sprintf('<li>%s (%s)</li>', $searchResult['snippet']['title'],  
//            $searchResult['id']['videoId']."<a href=http://www.youtube.com/watch?v=".$searchResult['id']['videoId']." target=_blank>   Watch This Video</a>");  
            $arrayOfVideos[$k]=$searchResult['id']['videoId'];
            $k++;
            
     
//        case 'youtube#channel':  
//          $channels .= sprintf('<li>%s (%s)</li>', $searchResult['snippet']['title'],  
//            $searchResult['id']['channelId']);  
//          break;  
       }
    } 
    echo  json_encode($arrayOfVideos);
   } catch (Google_ServiceException $e) {  
    $htmlBody .= sprintf('<p>A service error occurred: <code>%s</code></p>',  
      htmlspecialchars($e->getMessage()));  
  } catch (Google_Exception $e) {  
    $htmlBody .= sprintf('<p>An client error occurred: <code>%s</code></p>',  
      htmlspecialchars($e->getMessage()));  
  }
}
?>  
