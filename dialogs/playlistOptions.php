<?php
/**
 * Created by PhpStorm.
 * User: idz
 * Date: 4/4/15
 * Time: 6:16 PM
 */


?>


<md-dialog aria-label="Mango (Fruit)" ng-controller="PlaylistOptionsController">
    <md-content class="sticky-container">
        <md-subheader class="md-sticky-no-effect">Login</md-subheader>
        <div class="dialog-content">



Playlist OPTIONS


{{ employee }}







            <md-button ng-click="plystOptCtrl.showPlaylists()">
                Cancel
            </md-button>

        </div>
    </md-content>
    <div class="md-actions" layout="row">
        <md-button href="http://en.wikipedia.org/wiki/Mango" target="_blank" hide show-md>
            More on Wikipedia
        </md-button>
        <span flex></span>
        <md-button ng-click="answer('not useful')">
            Cancel
        </md-button>


        <md-button ng-click="loginCtrl.loginUser()" class="md-primary md-raised">
            Login
        </md-button>

    </div>
</md-dialog>