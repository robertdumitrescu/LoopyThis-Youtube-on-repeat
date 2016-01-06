$(document).ready(function () {
    $.material.init();
});

// Initialization

var $login_modal_wrapper = $("#LoginModal");
var $login_button = $("#LoginButton");
var $close_login_modal_button = $("#CloseLoginModalButton");
var $close_login_modal_x = $("#CloseLoginModalX");

var $register_modal_wrapper = $("#RegisterModal");
var $register_button = $("#RegisterButton");
var $close_register_modal_button = $("#CloseRegisterModalButton");
var $close_register_modal_x = $("#CloseRegisterModalX");

var $logout_modal_wrapper = $("#LogoutModal");
var $logout_button = $("#LogoutButton");
var $close_logout_modal_button = $("#CloseLogoutModalButton");
var $close_logout_modal_x = $("#CloseLogoutModalX");

var $informative_register_modal_wrapper = $("#InformativeRegister");
var $informative_register_button = $("#InformativeRegisterButton");
var $close_informative_register_modal_button = $("#CloseInformativeRegisterModalButton");
var $close_informative_register_modal_x = $("#CloseInformativeRegisterModalX");

var $playlist_select_modal_wrapper = $("#PlaylistSelect");
var $playlist_select_button = $("#PlaylistSelectButton");
var $close_playlist_select_modal_button = $("#ClosePlaylistSelectModalButton");
var $close_playlist_select_modal_x = $("#ClosePlaylistSelectModalX");


var $all_modals = [$login_modal_wrapper, $register_modal_wrapper, $logout_modal_wrapper, $informative_register_modal_wrapper, $playlist_select_modal_wrapper];
var custom_active_button = "custom-active-button";
var custom_inactive_button = "custom-inactive-button";
var $repeat_button = $(".repeat-button");
var $shuffle_button = $(".shuffle-button");
var $add_to_playlist_button = $(".add-to-playlist-button");
var $playlist_missing_account = $("#PlaylistMissingAccount");

// Initialization End

$login_button.click(function () {
    ModalOpenAction($login_modal_wrapper);
});

$close_login_modal_button.click(function () {
    ModalCloseAction($login_modal_wrapper);
});

$close_login_modal_x.click(function () {
    ModalCloseAction($login_modal_wrapper);
});

// =======================================================================================

$register_button.click(function () {
    ModalOpenAction($register_modal_wrapper);
});

$close_register_modal_button.click(function () {
    ModalCloseAction($register_modal_wrapper);
});

$close_register_modal_x.click(function () {
    ModalCloseAction($register_modal_wrapper);
});

// =======================================================================================

$logout_button.click(function () {
    ModalOpenAction($logout_modal_wrapper);
});

$close_logout_modal_button.click(function () {
    ModalCloseAction($logout_modal_wrapper);
});

$close_logout_modal_x.click(function () {
    ModalCloseAction($logout_modal_wrapper);
});

// =======================================================================================

$informative_register_button.click(function () {
    ModalOpenAction($informative_register_modal_wrapper);
});

$close_informative_register_modal_button.click(function () {
    ModalCloseAction($informative_register_modal_wrapper);
});

$close_informative_register_modal_x.click(function () {
    ModalCloseAction($informative_register_modal_wrapper);
});

// =======================================================================================

$playlist_select_button.click(function () {
    ModalOpenAction($playlist_select_modal_wrapper);
});

$("#ClosePlaylistSelectModalButton").click(function () {

    $(document).trigger('insertToPlaylist');
        // var arrayOfValues=[];
        // $(".checkValue").each(function(){ if($(this).is(":checked"))  arrayOfValues.push($(this).val());   }); 

        // $.getJSON('http://gdata.youtube.com/feeds/api/videos/'+player.getVideoUrl().split("=")[1]+'?v=2&alt=jsonc',function(data,status,xhr){

        //  $.post("insert_song.php", {values: arrayOfValues, song_name: data.data.title , song_url: player.getVideoUrl().split("=")[1] ,id : $("#hiddenUser").val()}).done(
        //      function (data) {
        //             console.log(data);
        //     });

        // });

});

$close_playlist_select_modal_button.click(function () {
    ModalCloseAction($playlist_select_modal_wrapper);
    $add_to_playlist_button.removeClass(custom_active_button);
    $add_to_playlist_button.addClass(custom_inactive_button);

});

$close_playlist_select_modal_x.click(function () {
    ModalCloseAction($playlist_select_modal_wrapper);
    $add_to_playlist_button.removeClass(custom_active_button);
    $add_to_playlist_button.addClass(custom_inactive_button);
});


$playlist_missing_account.click(function () {

    if ($informative_register_modal_wrapper.hasClass("zoomOut")) {
        $informative_register_modal_wrapper.removeClass("zoomOut");
    }
    $informative_register_modal_wrapper.addClass("zoomIn animated").css("display", "block");

});

function ModalOpenAction($modal) {

    if ($modal.hasClass("zoomOut")) {
        $modal.removeClass("zoomOut");
    }
    $modal.addClass("zoomIn animated").css("display", "block");

}

function ModalCloseAction($modal) {

    if ($modal.hasClass("zoomIn")) {
        $modal.removeClass("zoomIn");
    }
    $modal.addClass("zoomOut animated");
    setTimeout(function () {
        $modal.css("display", "none");
    }, 500);

}

// Extra stuff

function CloseAll($all_modals_array) {
    var $all_modals_length = $all_modals_array.length;
    for (var iter1 = 0; iter1 < $all_modals_length; iter1++) {
        ModalCloseAction($all_modals_array[iter1]);
    }
}

$(".modal-background").click(function () {
    CloseAll($all_modals);

});

$(document).keyup(function (e) {
    if (e.keyCode == 27) {
        CloseAll($all_modals);
    }
});

$('.modal-content').click(function (event) {
    event.stopPropagation();
});

// =============================== Functional Buttons =====================================

$repeat_button.click(function () {
    if ($repeat_button.hasClass("custom-inactive-button")) {
        $repeat_button.removeClass("custom-inactive-button");
        $repeat_button.addClass("custom-active-button repeat-playlist-button");
    } else if ($repeat_button.hasClass("repeat-playlist-button")) {
        $repeat_button.removeClass("repeat-playlist-button");
        $repeat_button.html("<i class=\"fa fa-play-circle-o\"></i>");
        $repeat_button.addClass("repeat-track-button");
    } else if ($repeat_button.hasClass("repeat-track-button")) {
        $repeat_button.removeClass("custom-active-button repeat-track-button");
        $repeat_button.html("<i class=\"fa fa-repeat\"></i>");
        $repeat_button.addClass("custom-inactive-button");
    }
});

$shuffle_button.click(function () {
    if ($shuffle_button.hasClass("custom-inactive-button")) {
        $shuffle_button.removeClass("custom-inactive-button");
        $shuffle_button.addClass("custom-active-button");
    } else if ($shuffle_button.hasClass("custom-active-button")) {
        $shuffle_button.removeClass("custom-active-button");
        $shuffle_button.addClass("custom-inactive-button");
    }
});

$add_to_playlist_button.click(function () {
    if ($add_to_playlist_button.hasClass("custom-inactive-button")) {
        $add_to_playlist_button.removeClass("custom-inactive-button");
        $add_to_playlist_button.addClass("custom-active-button");
    } else if ($add_to_playlist_button.hasClass("custom-active-button")) {
        $add_to_playlist_button.removeClass("custom-active-button");
        $add_to_playlist_button.addClass("custom-inactive-button");
    }
});