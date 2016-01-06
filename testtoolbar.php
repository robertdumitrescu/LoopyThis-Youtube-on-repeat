<?php
/**
 * Created by PhpStorm.
 * User: idz
 * Date: 4/5/15
 * Time: 9:15 PM
 */



?>

<html lang="en">
<head>
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/angular_material/0.8.3/angular-material.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=RobotoDraft:300,400,500,700,400italic">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="public/css/main2.css">
    <meta name="viewport" content="initial-scale=1"/>
</head>
<body layout="column">






<div ng-app="myApp" ng-cloak class="u-wideWrapper u-paddingHm u-paddingTl" ng-controller="MainController">



    <div class="Grid Grid--gutters md-Grid--2col">
       <div class="Grid-cell u-marginBl">
            <v-accordion class="vAccordion--default" multiple control="accordionB">

                <v-pane ng-repeat="pane in panes" expanded="$first">
                    <v-pane-header>
                        <h5>{{ pane.header }}</h5>
                    </v-pane-header>

                    <v-pane-content>
                        <p>{{ pane.content }}</p>

                        <v-accordion multiple ng-if="pane.subpanes">
                            <v-pane ng-repeat="subpane in pane.subpanes">
                                <v-pane-header>
                                    <h5>{{ subpane.header }}</h5>
                                </v-pane-header>
                                <v-pane-content>
                                    <p>{{ subpane.content }}</p>
                                </v-pane-content>
                            </v-pane>
                        </v-accordion>
                    </v-pane-content>
                </v-pane>
            </v-accordion>
       </div>
    </div>



</div>




<script src="assets/angular/js/angular.min.js"></script>
<script src="assets/angular/js/angular-animate.min.js"></script>
<script src="assets/angular/js/angular-aria.min.js"></script>
<script src="assets/angular/js/angular-material.min.js"></script>
<script src="assets/angular/js/v-accordion.js"></script>
<script src="public/js/main3.js"></script>

</body>
</html>