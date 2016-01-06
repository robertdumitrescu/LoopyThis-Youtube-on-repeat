
var app =  angular.module('myApp', [ 'ngAnimate', 'vAccordion', 'ngCookies']);

app.controller('MainController', function ($scope) {
            $scope.panes = [
                {
                    header: 'Pane 1',
                    content: 'Curabitur et ligula. Ut molestie a, ultricies porta urna. Vestibulum commodo volutpat a, convallis ac, laoreet enim. Phasellus fermentum in, dolor. Pellentesque facilisis. Nulla imperdiet sit amet magna. Vestibulum dapibus, mauris nec malesuada fames ac turpis velit, rhoncus eu, luctus et interdum adipiscing wisi.'
                },
                {
                    header: 'Pane 2',
                    content: 'Lorem ipsum dolor sit amet enim. Etiam ullamcorper. Suspendisse a pellentesque dui, non felis. Maecenas malesuada elit lectus felis, malesuada ultricies.'
                },
                {
                    header: 'Pane 3',
                    content: 'Aliquam erat ac ipsum. Integer aliquam purus. Quisque lorem tortor fringilla sed, vestibulum id, eleifend justo vel bibendum sapien massa ac turpis faucibus orci luctus non.',

                    subpanes: [
                        {
                            header: 'Subpane 1',
                            content: 'Lorem ipsum dolor sit amet enim.'
                        },
                        {
                            header: 'Subpane 2',
                            content: 'Curabitur et ligula. Ut molestie a, ultricies porta urna. Quisque lorem tortor fringilla sed, vestibulum id.'
                        }
                    ]
                }
            ];

        });