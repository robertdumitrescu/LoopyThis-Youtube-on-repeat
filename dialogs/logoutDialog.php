<?php
?>
<md-dialog aria-label="Mango (Fruit)" ng-controller="LogoutController as logoutCtrl">
    <md-content class="sticky-container">
        <md-subheader class="md-sticky-no-effect">Logout</md-subheader>
        <div class="dialog-content">

            <h1>Are you sure you want to log out?</h1>

        </div>
    </md-content>
    <div class="md-actions" layout="row">
        <md-button ng-click="logoutCtrl.logoutUser()" class="md-primary md-raised">
            Logout
        </md-button>
        <md-button ng-click="answer('not useful')">
            Cancel
        </md-button>
    </div>
</md-dialog>