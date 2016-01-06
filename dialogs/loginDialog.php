<?php
?>
<md-dialog aria-label="Mango (Fruit)" ng-controller="LoginController as loginCtrl">
    <md-content class="sticky-container">
        <md-subheader class="md-sticky-no-effect">Login</md-subheader>
        <div class="dialog-content">
            <form name="projectForm">
                <md-input-container>
                    <label>E-mail adress</label>
                    <input required name="loginEmail" ng-model="loginCtrl.loginObject.loginUserMail">
                    <div ng-messages="projectForm.clientName.$error3">
                        <div ng-message="required">This is required.</div>
                    </div>
                </md-input-container>
                <md-input-container>
                    <label>Password</label>
                    <input required name="loginPassword" type="password" ng-model="loginCtrl.loginObject.loginUserPassword">
                    <div ng-messages="projectForm.clientName.$error4pampam">
                        <div ng-message="required">This is required.</div>
                    </div>
                </md-input-container>
            </form>
        </div>
    </md-content>
    <div class="md-actions" layout="row">
        <md-button ng-click="loginCtrl.loginUser()" class="md-primary md-raised">
            Login
        </md-button>
        <md-button ng-click="answer('not useful')">
            Cancel
        </md-button>
    </div>
</md-dialog>