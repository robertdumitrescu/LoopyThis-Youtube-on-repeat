var app = angular.module('LoopyThisApp', ['ngMaterial', 'ngAnimate', 'vAccordion']);

app.value("toastDelay", "5500");

app.config(function ($mdThemingProvider) {
    $mdThemingProvider.theme('default')
        .primaryPalette('teal', {
            'default': "500"
        })
        .accentPalette('indigo');
});

app.directive('ngEnter', function () {
    return function (scope, element, attrs) {
        element.bind("keydown keypress", function (event) {
            if (event.which === 13) {
                scope.$apply(function () {
                    scope.$eval(attrs.ngEnter, {'event': event});
                });

                event.preventDefault();
            }
        });
    };
});

app.controller('InitStreamsController', function ($scope, $http, $mdToast, toastDelay, $rootScope) {

    this.registerObject = {};
    $rootScope.plNeedUp = false;

    $scope.trk = function () {

        $rootScope.currentActionType = "0";
        var utc_timestamp_unix = new Date().getTime();
        var utc_timestamp = new Date().toString();

        $http.post('trackController.php', {"client_timestamp": utc_timestamp_unix, "client_gmt": utc_timestamp}).
            success(function (data, status, headers, config) {
                // to be implemented
            }).
            error(function (data, status, headers, config) {

                // called asynchronously if an error occurs
                // or server returns response with an error status.
                // console.log("Client-side: There was a server error");

            });

        $http.post('authenticationController.php', {"rdTkn": "lala"}).
            success(function (data, status, headers, config) {

                // this callback will be called asynchronously
                // when the response is available
                // console.log("Client-side: Success");//
                // console.log(data);
                // var data_from_request = data;

                $rootScope.athToken = data;
                app.value("athToken", data);

                // console.log($rootScope.athToken);

            }).
            error(function (data, status, headers, config) {

                // called asynchronously if an error occurs
                // or server returns response with an error status.
                // console.log("Client-side: There was a server error");
                
            });
    };

    $scope.test = function () {

        //  console.log(typeof($rootScope.playlists_glb_object));

    };

});

app.controller('RegisterController', function ($mdDialog, $http, $mdToast, toastDelay) {

    this.registerObject = {};

    this.registerUser = function () {

        //  console.log(this.registerObject);

        $http.post('authenticationController.php', this.registerObject).
            success(function (data, status, headers, config) {

                // this callback will be called asynchronously
                // when the response is available
                // console.log("Client-side: Success");
                // console.log(data);*/

                $mdToast.show(
                    $mdToast.simple()
                        .content(data)
                        .position("bottom", "left")
                        .hideDelay(toastDelay)
                );
            }).
            error(function (data, status, headers, config) {

                // called asynchronously if an error occurs
                // or server returns response with an error status.
                // console.log("Client-side: There was a server error");

            });


        $mdDialog.hide();
    };

});

app.controller('LoginController', function ($mdDialog, $http, $mdToast, toastDelay, $window) {

    this.loginObject = {};

    this.loginUser = function () {

        //  console.log(this.loginObject);

        $http.post('authenticationController.php', this.loginObject).
            success(function (data, status, headers, config) {

                // this callback will be called asynchronously
                // when the response is available
                // console.log("Client-side: Success");
                // console.log(data);

                $mdToast.show(
                    $mdToast.simple()
                        .content(data)
                        .position("bottom", "left")
                        .hideDelay(toastDelay)
                );

                if (data == "0") {

                    $window.location.reload();

                }
            }).
            error(function (data, status, headers, config) {

                // called asynchronously if an error occurs
                // or server returns response with an error status.
                // console.log("Client-side: There was a server error");

            });
        $mdDialog.hide();
    };

});

app.controller('LogoutController', function ($mdDialog, $http, $mdToast, toastDelay, $window) {

    this.logoutUser = function () {
        this.logoutObject = {"logoutToken": "11"};

        $http.post('authenticationController.php', this.logoutObject).
            success(function (data, status, headers, config) {

                $mdToast.show(
                    $mdToast.simple()
                        .content(data)
                        .position("bottom", "left")
                        .hideDelay(toastDelay)
                );
                $window.location.reload();
            }).
            error(function (data, status, headers, config) {

                // called asynchronously if an error occurs
                // or server returns response with an error status.
                // console.log("Client-side: There was a server error");

            });

        $mdDialog.hide();
    };

});

app.controller('SidenavController', function ($http, $mdToast, toastDelay, $rootScope, $mdDialog, $mdSidenav) {

    this.newPlaylistName = "";
    this.athToken = "";

    this.toggleSidenav = function (menuId) {
        $mdSidenav(menuId).toggle();

    };

    this.playVideo = function (videoCode) {

        player.cueVideoById({'videoId': videoCode.trim(), 'startSeconds': 0});
        player.nextVideo();
        player.playVideo();

    };

    this.triggerShowLogin = function (ev) {
        $mdDialog.show({
            controller: DialogController,
            templateUrl: 'dialogs/loginDialog.php',
            targetEvent: ev
        })
    };

    this.triggerShowRegister = function (ev) {
        $mdDialog.show({
            controller: DialogController,
            templateUrl: 'dialogs/registerDialog.php',
            targetEvent: ev
        })
    };

    this.triggerShowLogout = function (ev) {
        $mdDialog.show({
            controller: DialogController,
            templateUrl: 'dialogs/logoutDialog.php',
            targetEvent: ev
        })
    };

    this.resetPlaylistName = function(){

        this.newPlaylistName = "";

    };

    this.deleteSongFromPlaylist = function(ltsp_playlist_id, ltsp_song_id, playlist_index, song_index){

        $http.post('playlistController.php', {"playlistId": ltsp_playlist_id, "songCode": ltsp_song_id, "athTokenDlSngFrmPl": $rootScope.athToken}).
            success(function (data, status, headers, config) {

                $mdToast.show(
                    $mdToast.simple()
                        .content(data)
                        .position("bottom", "left")
                        .hideDelay(toastDelay)
                );
                //console.log($rootScope.playlists_glb_object[playlist_index].songs[song_index]);
               // $rootScope.playlists_glb_object.splice(playlist_index,1);

                $rootScope.playlists_glb_object[playlist_index].songs.splice(song_index,1);

            }).
            error(function (data, status, headers, config) {
                // called asynchronously if an error occurs
                // or server returns response with an error status.
                console.log("Client-side: There was a server error");
            });

    };

    this.addPlaylist = function (playlist_name) {

        $rootScope.playlists_loading = true;
        $rootScope.playlists_glb_object = "";
        $http.post('playlistController.php', {"playlistName": playlist_name, "athTokenPl": $rootScope.athToken}).
            success(function (data, status, headers, config) {

                $mdToast.show(
                    $mdToast.simple()
                        .content(data)
                        .position("bottom", "left")
                        .hideDelay(toastDelay)
                );

                $http.post('playlistController.php', {"athTokenPlModel": $rootScope.athToken}).
                    then(function (data, status, headers, config) {

                        // this callback will be called asynchronously
                        // when the response is available
                        // console.log("Client-side: Success");
                        // playlistsContainer.empty();
                        // console.log(data.data);

                        $rootScope.playlists_glb_object = data.data;

                        setTimeout(function () {

                            $rootScope.playlists_loading = false;

                        }, 500);
                    });
            }).
            error(function (data, status, headers, config) {

                // called asynchronously if an error occurs
                // or server returns response with an error status.
                console.log("Client-side: There was a server error");

            });
        //  console.log(this.glb_object);
    };
});

app.controller('SearchToolbarController', function ($scope, $mdDialog, $http, $rootScope) {

    this.apiSearch = function (searchQuery) {
        $rootScope.video_results_exist = true;
        $rootScope.resulting_objects = [];

        //   $rootScope.resulting_objects= new Array();

        $http.post('youtubeController.php', {"searchQuery": searchQuery}).
            success(function (data, status, headers, config) {

                for (var iter = 0; iter < data.length; iter++) {

                    //console.log(data[iter]);

                    $http.get('https://www.googleapis.com/youtube/v3/videos?id='+ data[iter] +'&key=AIzaSyCwfiYOUJSg-ch4xjNm3yNUHROgLND-Hkw&part=snippet,contentDetails,statistics,status').

                    //$http.get('http://gdata.youtube.com/feeds/api/videos/' + data[iter] + '?v=3&alt=jsonc').

                        success(function (data, status, headers, config) {
                            console.log(data);
                            $rootScope.resulting_objects.push(angular.fromJson(data));

                        }).
                        error(function (data, status, headers, config) {

                            // called asynchronously if an error occurs
                            // or server returns response with an error status.

                        });
                }

            }).
            error(function (data, status, headers, config) {

                // called asynchronously if an error occurs
                // or server returns response with an error status.
                // console.log("Client-side: There was a server error");

            });
    };
});

app.controller('LeftToolbarController', function ($mdDialog, $mdSidenav, $http, $rootScope) {

    this.toggleSidenav = function (menuId) {
        $mdSidenav(menuId).toggle();

        if (typeof($rootScope.playlists_glb_object) == "undefined") {

            $http.post('playlistController.php', {"athTokenPlModel": $rootScope.athToken}).
                then(function (data, status, headers, config) {

                    $rootScope.playlists_glb_object = data.data;

                })

        } else if ($rootScope.plNeedUp == true) {

          //  $rootScope.playlists_loading = true;
            $http.post('playlistController.php', {"athTokenPlModel": $rootScope.athToken}).
                then(function (data, status, headers, config) {

                    $rootScope.plNeedUp = false;
                    //  console.log(data.data);
                    $rootScope.playlists_glb_object = data.data;

                   //setTimeout(function(){
                   //
                   //    $rootScope.playlists_loading = false;
                   //
                   // }, 600);

                })
        }
    };

    this.showRegisterFeature = function (ev) {
        $mdDialog.show({
            controller: DialogController,
            templateUrl: 'dialogs/registerFeatureDialog.php',
            targetEvent: ev
        })
    };
});

app.controller('RightToolbarController', function ($scope, $mdDialog, $http, $rootScope) {
    this.showLogin = function (ev) {
        $mdDialog.show({
            controller: DialogController,
            templateUrl: 'dialogs/loginDialog.php',
            targetEvent: ev
        })
    };

    this.showRegister = function (ev) {
        $mdDialog.show({
            controller: DialogController,
            templateUrl: 'dialogs/registerDialog.php',
            targetEvent: ev
        })
    };

    this.showLogout = function (ev) {
        $mdDialog.show({
            controller: DialogController,
            templateUrl: 'dialogs/logoutDialog.php',
            targetEvent: ev
        })
    };
});

app.controller('GeneralActionsController', function ($scope, $mdDialog, $http, $rootScope) {

    this.repeatActionMsg = "Repeat only current track";

    this.repeatActionsClasses = function () {

        var className = 'initClass';

        if ($rootScope.currentActionType == "1")
            className = 'dsadsa';

        if ($rootScope.currentActionType == "2")
            className = 'initCldsadsadsaass';

        return className;
    };

    this.repeatActionsIconsClasses = function () {

        var className = 'fa fa-repeat';

        if ($rootScope.currentActionType == "1")
            className = 'fa fa-play-circle-o';

        if ($rootScope.currentActionType == "2")
            className = 'fa fa-repeat';

        return className;
    };

    this.repeatActions = function () {

        //  console.log("Initial: " + $rootScope.currentActionType);
        if ($rootScope.currentActionType == "1") {

            $rootScope.currentActionType = "2";
            this.repeatActionMsg = "Repeat current playlist";

        } else if ($rootScope.currentActionType == "2") {

            $rootScope.currentActionType = "0";
            this.repeatActionMsg = "No repeat";

        } else if ($rootScope.currentActionType == "0") {
            $rootScope.currentActionType = "1";
            this.repeatActionMsg = "Repeat only current track";
        }
        //  console.log("Final: " + $rootScope.currentActionType);
        //  console.log("ai apasat");

    };

    this.showRegisterFeature = function (ev) {
        $mdDialog.show({
            controller: DialogController,
            templateUrl: 'dialogs/registerFeatureDialog.php',
            targetEvent: ev
        })
    };

    this.showPlaylistOptions = function (ev) {


        $http.post('playlistController.php', {"athTokenPlOptModel": $rootScope.athToken, "songCode": player.getVideoUrl()}).
            then(function (data, status, headers, config) {

                // this callback will be called asynchronously
                // when the response is available
                //  console.log("Client-side: Success");
                // console.log(data.data);

                $rootScope.playlists_glb_object = data.data;
                $mdDialog.show({
                    targetEvent: ev,
                    template: '<md-dialog aria-label="Mango (Fruit)">' +
                        '<md-content class="sticky-container">' +
                        '<md-subheader class="md-sticky-no-effect">Playlist options</md-subheader>' +
                        '<div class="dialog-content">' +
                        '<md-checkbox ng-model="playlist.assoc_on" aria-label="Checkbox 1" ng-repeat="playlist in playlists">' +
                        '<div>{{ playlist.lt_playlists_name }}</div>' +
                        '</md-checkbox>' +
                        '</div>' +
                        '</md-content>' +
                        '<div class="md-actions" layout="row">' +
                        '<span flex></span>' +
                        '<md-button ng-click="closePlaylistOptionDialog()">' +
                        'Cancel' +
                        '</md-button>' +
                        '<md-button ng-click="saveSongPlaylistAssoc()" class="md-primary md-raised">' +
                        'Update Playlists' +
                        '</md-button>' +
                        '</div>' +
                        '</md-dialog>',
                    controller: 'PlaylistOptionsController',
                    locals: { playlists: $rootScope.playlists_glb_object }
                });
            })
    };
});


app.controller('PlaylistOptionsController', function ($scope, playlists, $http, $rootScope, $mdDialog, toastDelay, $mdToast) {

    $scope.playlists = playlists;
    $scope.saveSongPlaylistAssoc = function () {

        $http.post('playlistController.php', {"athTokenPlOptUpModel": $rootScope.athToken, "songCode": player.getVideoUrl(), "playlists_obj_updated": $scope.playlists}).
            then(function (data, status, headers, config) {

                // this callback will be called asynchronously
                // when the response is available

                $mdToast.show(
                    $mdToast.simple()
                        .content("Playlists updated successfully")
                        .position("bottom", "left")
                        .hideDelay(toastDelay)
                );

                // console.log(data.data);

            });

         //console.log($scope.playlists);
         //console.log(player.getVideoUrl());

        $rootScope.plNeedUp = true;
        $mdDialog.hide();
    };

    $scope.closePlaylistOptionDialog = function () {
        $mdDialog.hide();
    };
});

app.controller('SearchResultsController', function ($http) {
    this.insertVideo = function (data_ini) {

        player.cueVideoById({'videoId': data_ini.trim(), 'startSeconds': 0});
        player.nextVideo();
        player.playVideo();

        $http.post('songController.php', {"object": data_ini}).
            success(function (data, status, headers, config) {

                // console.log("Client-side: Success");
                // console.log(data);

            }).
            error(function (data, status, headers, config) {

                // called asynchronously if an error occurs
                // or server returns response with an error status.
                // console.log("Client-side: There was a server error");

            });
    };
});

function DialogController($scope, $mdDialog) {
    $scope.hide = function () {
        $mdDialog.hide();
    };
    $scope.cancel = function () {
        $mdDialog.cancel();
    };
    $scope.answer = function (answer) {
        $mdDialog.hide(answer);
    };
}


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
        video = 'WTrNsAsjEmY';

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

onYouTubeIframeAPIReady();

function onPlayerStateChange(event) {
     //   if($(".repeat-button").hasClass('repeat-track-button')) {
     //if (event.data === 0) {
    if (event.data === 0) {
        player.playVideo();
    } else {

    }
    //}
    //   }
    // $(".repeat-button").on("change-state",function(){
    // if (event.data === 0) {
    // }
    // });

}













