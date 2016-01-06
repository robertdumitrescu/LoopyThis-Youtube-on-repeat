<!DOCTYPE html>
<html lang="en">
<head>

    <?php

    $canonical_link = "http://www.loopythis.com";
    $base_description = "Listen on repeat with this new awesome service. Loopy this is the answer. Loop on media giants content like Youtube Vimeo";
    $base_title = "LoopyThis";
    $custom_title= " - Listen on repeat";


    include_once("seo.php");

    generateSEO($canonical_link, $base_description, $base_title, $custom_title);
    ?>


<?php

include_once("assets.php");

?>


    <script>

        function generate_snackbar(message) {
            $.snackbar({content: message});
        }

    </script>

    <?php
    include_once("functions.php");
    if(!isset($_SESSION))
    {
        session_start();
    }
    //include_once('youtubeController.php');
    //error_reporting(0); //initializare erori pe 0
    //ini_set("display_errors", 0);
    //echo $_SERVER['REMOTE_ADDR'];
    ?>

    <style>
        form {
            color: black !important;
        }
        #searchForm {
            margin: 0 !important;
        }
    </style>

</head>
<body>
<?php include_once("analytics_tracking.php") ?>
<div id="snackbar-container">
    <div id="snackbar1424027280524" class="snackbar">
    </div>
</div>
<?php include_once("login_register.php");
verify_authenticity($_SERVER['REMOTE_ADDR']);
//block_temporary($_SERVER['REMOTE_ADDR']);
?>

<!-- Your site -->

<div class="navbar navbar-inverse custom-navbar skin-1-navbar navbar-fixed-top">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-inverse-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>


        <?php
        $default_left_header = "<a href=\"javascript:void(0)\" id=\"InformativeRegisterButton\" class=\"navbar-brand\">";
        $default_left_header .= "Playlist&nbsp;&nbsp;";
        $default_left_header .= "<i class=\"custom-playlist-icon fa fa-bars\"></i>";
        $default_left_header .= "</a>";
        $default_left_header .= "<a href=\"javascript:void(0)\" class=\"navbar-brand\">";
        $default_left_header .= "|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;LoopyThis.com";
        $default_left_header .= "</a>";
        $logged_in_left_header = "<a href=\"#menu-toggle\" class=\"navbar-brand\" id=\"menu-toggle\">";
        $logged_in_left_header .= "Playlist&nbsp;&nbsp;";
        $logged_in_left_header .= "<i class=\"custom-playlist-icon fa fa-bars\"></i>";
        $logged_in_left_header .= "</a>";
        $logged_in_left_header .= "<a href=\"javascript:void(0)\" class=\"navbar-brand\">";
        $logged_in_left_header .= "|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;LoopyThis.com"."<img class='logoImage rubberBand animated' src='public/images/default-user-icon.png' alt='Loopy This logo / Loopythis.com logo' />";
        $logged_in_left_header .= "</a>";
        $logged_in_left_header.="";
        if (!isset($_SESSION['id'])){
            echo $default_left_header;
        }
        if (isset($_SESSION['id'])){
            echo $logged_in_left_header;
        }
        ?>

    </div>


    <div class="navbar-collapse collapse navbar-inverse-collapse">


        <ul class="nav navbar-nav navbar-right custom-navbar-right">


            <li><form class="navbar-form navbar-left custom-search" id='searchForm' method="POST">
                <input type="text" placeholder="Search" class="form-control custom-search-field" value="" name="searchText" id="searchTextId">

                <a href="javascript:void(0)" name="searchBtn" id="searchT" class="btn execute-Query"><i
                        class="fa fa-search"></i></a>

            </form></li>


            <?php
            $default_right_header = "<li><a href=\"javascript:void(0)\" id=\"LoginButton\" class='navbar-name-initial'>Login</a></li>";
            $default_right_header .= "<li><a href=\"javascript:void(0)\" id=\"RegisterButton\" class='navbar-name-initial'>Register</a></li>";
            if (isset($_SESSION['id'])){
                $logged_in_right_header = "<li class=\"dropdown\"><a href=\"bootstrap-elements.html\" id=\"\" data-target=\"#\" class=\"custom-dropdown-wrapper dropdown-toggle\" data-toggle=\"dropdown\"><div class=\"custom-dropdown-caret-wrapper\"><img class=\"user_thumbnail\" src=\"public/images/default-user-icon.png\" alt='User photo loopy this / default user photo'><div class=\"custom-dropdown-caret\"><small><b class=\"caret\"></b></small></div></div><div class='navbar-name'>".explode("@",$_SESSION['email'])[0]."</div></a>";
                $logged_in_right_header .= "<ul class=\"dropdown-menu\">";
                $logged_in_right_header .= "<li><a href=\"javascript:void(0)\"><i class=\"fa fa-user\"></i>&nbsp;&nbsp;&nbsp;Profile</a></li>";
                $logged_in_right_header .= "<li><hr class=\"custom-dropdown-divider\"></li>";
                $logged_in_right_header .= "<li><a href=\"javascript:void(0)\" id=\"LogoutButton\"><i class=\"fa fa-power-off\"></i>&nbsp;&nbsp;&nbsp;Logout</a></li>";
                $logged_in_right_header .= "</ul></li>";
            }

            ?>

            <?php
            if (!isset($_SESSION['id'])){
                echo $default_right_header;
            }

            ?>
            <?php
            if (isset($_SESSION['id'])){
                echo $logged_in_right_header;
            }
            ?>
        </ul>
    </div>
</div>


<div id="wrapper" class="toggled custom-wrapper wrapper">


<!-- Sidebar -->
<div id="sidebar-wrapper" class="skin-1-sidebar">
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default custom-panel-default">
            <div class="skin-1-playlist-title panel-heading custom-panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title custom-panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#newPlaylist" aria-expanded="true"
                       aria-controls="newPlaylist">
                        New Playlist <span><small><i class="skin-1-new-playlist-sign fa fa-plus"></i></small></span>
                    </a>
                </h4>
            </div>
            <div id="newPlaylist" class="panel-collapse collapse in skin-1-collapsed-playlist" role="tabpanel"
                 aria-labelledby="headingOne">
                <div class="panel-body custom-panel-body">


                    <div class="form-group">
                        <div class="col-lg-12">
                            <input type="text" class="form-control" id="playlistNameInput" name="playlistName"
                                   placeholder="Playlist name">
                        </div>
                    </div>

                    <div class="row">

                        <a href="#" class="ResetPlaylistButton">
                            <div
                                class="col-xs-6 new-playlist-buttons skin-1-new-playlist-buttons new-playlist-buttons-reset">
                                <small>Reset</small>
                            </div>
                        </a>

                        <a href="#">
                            <div class="col-xs-6 new-playlist-buttons skin-1-new-playlist-buttons new-playlist-buttons-insert">
                                <small>Save</small>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>



<div id='dinamic_playlist'></div>

</div>

</div>
<!-- /#sidebar-wrapper -->

<div id="page-content-wrapper" class="custom-main-container">

    <div class="container">
        <select id='songId' style='display:none;'>
            
        </select>
        <div class="query-results-wrapper hide jumbotron custom-jumbotron">
            <div class="query-results collapse" id="query-results">
                <ul id='listOfVideos'>
                    
                </ul>
            </div>
            <div class="query-results-collapse"><a class="btn btn-primary btn-xs custom-collapse"
                                                   href="javascript:void(0)" data-toggle="collapse"
                                                   data-target="#query-results">Expand Results</a></div>
        </div>
<script src="http://www.youtube.com/player_api"></script>
        <div id='player'></div>
        <script>

    var player;
    function onYouTubeIframeAPIReady() {
            var url = document.URL; //echivalentul metodei $_GET
            if (url.indexOf("v=") != -1) {
                var video = url.split("v=")[1];
                if (video.indexOf("&") != 1) { //testam aici daca e playlist in caz ca e ne intereseaza doar melodia
                    video = escape(video.split("&")[0]);
                }
            }
            else
                video = '1AIu7SqX_UI';
            
            player = new YT.Player('player', {
                height: '390',
                width: '700',
                videoId: video,
                events: {
                    'onReady': onPlayerReady,
                    'onStateChange': onPlayerStateChange
                }
            });
    }

    function onPlayerReady(event) {
        event.target.playVideo();
    }


    function onPlayerStateChange(event) {
        if($(".repeat-button").hasClass('repeat-track-button')) {
                    if (event.data === 0) {
                        player.playVideo();}
        }
        $(".repeat-button").on("change-state",function(){
                    if (event.data === 0) {
                        }           
        });

    }

    function stopVideo() {
        player.stopVideo();
    }

        </script>
        <div class="row">
            <div class="col-xs-5">
                <?php if(isset($_SESSION['id'])){?>
                <?php
                
                ?>
                <div class="checkbox">
                    <div class="btn-group">
                        <a href="javascript:void(0)" id="PlaylistSelectButton" class="add-to-playlist-button btn btn-default custom-inactive-button "><small><i class="fa fa-plus-square"></i></small></a>
                    </div>
                </div>
                <?php } else {?>
                    <div class="checkbox">
                        <div class="btn-group">
                            <a href="javascript:void(0)" id="PlaylistMissingAccount" class="add-to-playlist-button btn btn-default custom-inactive-button "><small><i class="fa fa-plus-square"></i></small></a>
                        </div>
                    </div>
                <?php }?>

            </div>
            <div class="col-xs-5">
                <div class="checkbox">
                    <div class="btn-group">
                        <a href="javascript:void(0)" class="repeat-button btn btn-default custom-active-button repeat-track-button"><i class="fa fa-play-circle-o"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-xs-2">
                <div class="checkbox">
                    <div class="btn-group pull-right">
                        <a href="javascript:void(0)" class="shuffle-button btn btn-default custom-inactive-button"><i class="fa fa-random"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <br>

        <div class="jumbotron">
            <h1>Now with more features</h1>

            <p>This is a simple hero unit, a simple jumbotron-style component for calling extra attention to
                featured
                content or information.</p>

            <p><a class="btn btn-primary btn-lg">Learn more</a></p>
        </div>
    </div>
</div>
    <div class="push"></div>
</div>

<div class="footer">
    <div class="container">
        <div class="footer-wp">
        <ul class="footer-buttons">
            <li class="footer-button">
                <a class="ft-link" href=""> Contact</a>
            </li>
            <li class="footer-button">
                <a class="ft-link" href="manifesto.php">Manifesto</a>
            </li>
            <li class="footer-button">
                <a class="ft-link" href=""> Blog</a>
            </li>
            <li class="footer-button">
                <a class="ft-link" href="terms.php">Terms</a>
            </li>
            <li class="footer-button">
                <a class="ft-link" href="privacy.php"> Privacy Policy</a>
            </li>
        </ul>
        <div class="footer-info pull-right">
            Copyright (c) 2008 - Loopy This
        </div>
        </div>
    </div>
</div>


 <div class="modal modal-background" id="PlaylistSelect">
    <div class="modal-dialog PlaylistSelectDialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="ClosePlaylistSelectModalX"><i class="fa fa-times"></i>
                </button>
                <h4 class="modal-title">Playlist Select</h4>
            </div>
            <div class="modal-body" >
                <fieldset id='modalPlaylist-body'>



                </fieldset>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="ClosePlaylistSelectModalButton">I'm done</button></div>
            </div>

        </div>
    </div>
</div> 


<div class="modal modal-background" id="InformativeRegister">
    <div class="modal-dialog InformativeRegisterDialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="CloseInformativeRegisterModalX"><i class="fa fa-times"></i>
                </button>
                <h4 class="modal-title">Please Register</h4>
            </div>
            <div class="modal-body">
                <fieldset>
                <h4>The <b>Playlist</b> feature is available just to
                    <a href="javascript:void(0)">registered</a> users.
                    If you already have an account, please <a href="javascript:void(0)">login.</a></h4>


                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"
                            id="CloseInformativeRegisterModalButton">
                        Actually... Nevermind
                    </button>
                </div>
                </fieldset>
            </div>

        </div>
    </div>
</div>


<div class="modal modal-background" id="LoginModal">
    <div class="modal-dialog LoginModalDialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="CloseLoginModalX"><i class="fa fa-times"></i>
                </button>
                <h4 class="modal-title">Enter in Mordor</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method='POST'>
                    <fieldset>
                        <div class="form-group">
                            <label for="inputLoginEmail" class="col-lg-2 control-label">Email</label>

                            <div class="col-lg-10">
                                <input type="email" class="form-control" id="inputLoginEmail" name="loginEmail"
                                       placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputLoginPassword" class="col-lg-2 control-label">Password</label>

                            <div class="col-lg-10">
                                <input type="password" class="form-control" id="inputLoginPassword" name='loginPassword'
                                       placeholder="Password">
                            </div>
                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"
                                    id="CloseLoginModalButton">
                                Actually... Nevermind
                            </button>
                            <button type="submit" class="btn btn-primary" name="loginBtn">Login</button>
                        </div>
                    </fieldset>
                </form>
            </div>

        </div>
    </div>
</div>


<div class="modal modal-background" id="RegisterModal">
    <div class="modal-dialog registerModalDialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="CloseRegisterModalX"><i class="fa fa-times"></i>
                </button>
                <h4 class="modal-title">Register</h4>
            </div>
            <div class="modal-body">


                <form class="form-horizontal" method="POST">
                    <fieldset>
                        <div class="form-group">
                            <label for="inputRegisterEmail" class="col-lg-2 control-label">Email</label>

                            <div class="col-lg-10">
                                <input type="email" class="form-control" name="emailRegister" id="inputRegisterEmail"
                                       placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputRegisterPassword" class="col-lg-2 control-label">Password</label>

                            <div class="col-lg-10">
                                <input type="password" class="form-control" name="passwordRegister"
                                       id="inputRegisterPassword" placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputRegisterPassword" class="col-lg-2 control-label">Re-type</label>

                            <div class="col-lg-10">
                                <input type="password" class="form-control" name="passwordReRegister"
                                       id="inputRegisterRePassword" placeholder="Confirm Password">
                            </div>
                        </div>
                    </fieldset>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"
                                id="CloseRegisterModalButton">
                            Neah, I'm ok.
                        </button>
                        <button type="submit" class="btn btn-primary" name="registerBtn">Register</button>

                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<div class="modal modal-background" id="LogoutModal">
    <div class="modal-dialog logoutModalDialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="CloseLogoutModalX"><i class="fa fa-times"></i>
                </button>
                <h4 class="modal-title">Oh...Snap</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST">
                    <fieldset>
                        Are you sure?
                    </fieldset>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" id="CloseLogoutModalButton">
                            Actually...NO!
                        </button>
                        <button type="submit" class="btn btn-primary" name='logoutBtn'>Yes, I'm sure</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
    $("#menu-toggle").click(function (e) {

        var custom_playlist_icon = $(".custom-playlist-icon");

        if (custom_playlist_icon.hasClass("fa-bars")) {
            custom_playlist_icon.removeClass("fa-bars");
            custom_playlist_icon.addClass("fa-times");
        } else {
            custom_playlist_icon.removeClass("fa-times");
            custom_playlist_icon.addClass("fa-bars");
        }


        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
        if ($("#wrapper").hasClass("toggled")) {

            $(".footer-wp").css({
                'width' : 'auto',
                'margin-left' : '0'
            });
        } else {

            $(".footer-wp").css({
                'width' : $(".container").width(),
                'margin-left' : '120px'
            });

        }
       /*     $(".footer-wp").toggle(function () {
                $(".footer-wp").css("background-color", "red");
            }, function () {
                $(".footer-wp").css("background-color", "red");
            });*/

    });
</script>

<script>



    $(".repeat-button").click(function(){
        $(this).trigger('change-state');

    });

    function insertS(data) {
        player.cueVideoById({'videoId': data.trim() , 'startSeconds': 0});
        player.nextVideo();
        player.playVideo();
    }

    $("#searchT").click(function () {

        query_results.collapse();

        $.post("youtubeController.php", {name: $("input[name='searchText']").val()}).done(
            function (data) {
                $("#listOfVideos").html('');
                 $("#songId").find('option').remove();
                var k=0;
                JSON.parse(data,function(key,value){
                    if(k==0) {
                        //console.log('vALOARE IMPORTANTA'+value);

                        insertS(value);
                        k++;
                    }
                    else {
                        
                    $.getJSON('http://gdata.youtube.com/feeds/api/videos/'+value+'?v=2&alt=jsonc',function(data,status,xhr){
                         $("#songId").append("<option value='"+value+"'>"+data.data.title+"</option>");
                        if(k<=9)
                        $("#listOfVideos").append("<div class=\"result-element-wrapper\"><img class=\"thumbImage\" src=http://img.youtube.com/vi/"+value+"/0.jpg"+">"+"<span class='song-title'>"+data.data.title+"</span>"+"</div>");
                        k++; });

                    }
                });

            });
    });

    var $query_results_wrapper = $(".query-results-wrapper");
    var query_results = $("#query-results");
    $(document).keypress(function(e) {
    if(e.which == 13) {
        e.preventDefault();
                if ($query_results_wrapper.hasClass("hide")) {
            $query_results_wrapper.removeClass("hide");
            $query_results_wrapper.addClass("show");

                    query_results.collapse();
        }
 

        $.post("youtubeController.php", {name: $("input[name='searchText']").val()}).done(
            function (data) {
                $("#listOfVideos").html('');
                $("#listOfVideos").empty();
                $("#songId").find('option').remove();
                var k=0;

                JSON.parse(data,function(key,value){
                    
                    if(k==0) {  insertS(value);  k++; }
                             else {
                         
                    $.getJSON('http://gdata.youtube.com/feeds/api/videos/'+value+'?v=2&alt=jsonc',function(data,status,xhr){
                        $("#songId").append("<option value='"+value+"'>"+data.data.title+"</option>");
                        if(k<=9)
                        $("#listOfVideos").append("<div class=\"result-element-wrapper\"><img class=\"thumbImage\" src=http://img.youtube.com/vi/"+value+"/0.jpg"+">"+"<span class='song-title'>"+data.data.title+"</span>"+"</div>");
                        k++; });

                    }
                        });
                         });

                insertS(data);
             }});


    $(".new-playlist-buttons-insert").click(function () {
                    $.post("insert_playlist.php", {name: $("#playlistNameInput").val().trim()}).done(
                        function (data) {
                            generate_snackbar(data);
                            $.post("dynamic_playlist.php").done(function(data){
                            $("#dinamic_playlist").html(data);
                });
            });
    });


    $(".execute-Query").click(function () {
        if ($query_results_wrapper.hasClass("hide")) {
            $query_results_wrapper.removeClass("hide");
            $query_results_wrapper.addClass("show")
        }
    });

    $('body').delegate(".result-element-wrapper","click",function(){
            var contor=$(this).index();
            var i=0;

        $(".query-results").collapse('hide');

            $("#songId").find("option").each(function(){
                if(i==contor) {
                    insertS($(this).val());
                }
                i++;
            });

        });

    $('body').delegate(".PlaylistSong","click",function(){

         insertS($(this).attr('value').trim());

    });

    $(".query-result-row").click(function () {
        $(".query-results").collapse('hide');
    });
</script>
<?php if(isset($_SESSION['id'])) {

    ?>
<script>
    $('#PlaylistSelectButton').click(function(){
        $("#modalPlaylist-body").html('');
        $.post('addToPlaylist.php').done(function(data){
            $("#modalPlaylist-body").empty();
            $("#modalPlaylist-body").append(data);
        });
    });
</script>
<?php }?>
<script>
    $(".new-playlist-buttons-reset").click(function(){
        
    });

    $(document).on("insertToPlaylist",function(){
                
        var arrayOfValues=[];
        $(".checkValue").each(function(){
            if($(this).is(":checked"))
                arrayOfValues.push($(this).val());
        });

        if(arrayOfValues.length!=0) {
        $.getJSON('http://gdata.youtube.com/feeds/api/videos/'+player.getVideoUrl().split("v=")[1]+'?v=2&alt=jsonc',function(data,status,xhr){

         $.post("insert_song.php", {values: arrayOfValues, song_name: data.data.title , song_url: player.getVideoUrl().split("v=")[1] }).done(
             function (data) {
                 console.log(data);
                    generate_snackbar(data);
                    $("#dinamic_playlist").html('');
                    $.post("dynamic_playlist.php").done(function(data){
                    $("#dinamic_playlist").html(data);
                });
            });
        });
        }
    });

       $(document).delegate(".deletePlaylistClass",'click',function(){

           console.log($(this).data("fepid"));


            var playlist_id = $(this).data("fepid");

           $.post("delete_playlist.php",{fepid: playlist_id}).done(
               function (data) {

                   generate_snackbar(data);

                   $("#dinamic_playlist").html('');
                   $.post("dynamic_playlist.php").done(function(data){
                       $("#dinamic_playlist").html(data);
                   });

                   });
       });




    $(document).delegate(".deletePlaylistSong",'click',function(){

        var playlist_id = $(this).data("fepid");
        var song_id = $(this).data("fesid");

        $.post("delete_song.php",{fepid: playlist_id, fesid: song_id}).done(
            function (data, current_item) {

                generate_snackbar(data);

            });


        $(this).closest('li').remove();

    });


    setInterval(function(){ $('.logoImage').toggleClass('rubberBand animated'); },1500);

$(".ResetPlaylistButton").click(function(){

    $("#playlistNameInput").val('');

});




</script>

<?php 
if(isset($_SESSION['id'])) {

    $id=$_SESSION['id'];
    $real_id=$_SESSION['real_id'];
    echo "<script>";   
    echo "$(document).ready(function(){";
    echo  "$.post('dynamic_playlist.php').done(function(data){";
                 
                  echo '$("#dinamic_playlist").html(data);';
               
    echo "}); });";
    echo "</script>";  
}
?>


<?php
if (isset($_GET['v'])) {
    echo "<script>" . "insertS(" . "'" . htmlentities($_GET['v']) . "'" . ")" . "</script>";
}


?>

<script src="public/js/main.js"></script>
</body>
</html>
