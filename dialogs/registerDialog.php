<?php
?>
<md-dialog aria-label="Mango (Fruit)" ng-controller="RegisterController as regCtrl">
    <md-content class="sticky-container">
        <md-subheader class="md-sticky-no-effect">Register</md-subheader>
        <div class="dialog-content">
            <form name="projectForm" novalidate>
                <md-input-container>
                    <label>E-mail adress</label>
                    <input required name="loginEmail" ng-model="regCtrl.registerObject.userMail">
                    <div ng-messages="projectForm.clientName.$error3">
                        <div ng-message="required">This is required.</div>
                    </div>
                </md-input-container>

                <md-input-container>
                    <label>Password</label>
                    <input required name="loginPassword" type="password" ng-model="regCtrl.registerObject.userPassword">
                    <div ng-messages="projectForm.clientName.$error4pampam">
                        <div ng-message="required">This is required.</div>
                    </div>
                </md-input-container>

                <md-input-container>
                    <label>Confirm Password</label>
                    <input required name="confirmPassword" type="password" ng-model="regCtrl.registerObject.userRepeatedPassword">
                    <div ng-messages="projectForm.clientName.$error4pampamampam">
                        <div ng-message="required">This is required.</div>
                    </div>
                </md-input-container>
            </form>
        </div>
    </md-content>
    <div class="md-actions" layout="row">
        <md-button ng-click="regCtrl.registerUser()" class="md-primary md-raised">
            Register
        </md-button>
        <md-button ng-click="answer('not useful')">
            Cancel
        </md-button>
    </div>
</md-dialog>