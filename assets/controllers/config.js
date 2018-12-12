'use strict';

app.config(['$stateProvider','$urlRouterProvider', function($stateProvider,$urlRouterProvider){
    $urlRouterProvider.otherwise('/login');

    $stateProvider
        .state('login', {
            url: '/login',
            views: {
                '': {templateUrl: 'welcome/index',controller: 'loginCtrl'}
            }
        })
        .state('home', {
            url: '/collection',
            views: {
                '': {templateUrl: 'welcome/home',controller: 'mainCtrl', abstract:true},
                'header@home': {templateUrl: 'welcome/header'},
                'sidebar@home': {templateUrl: 'welcome/sidebar'},
                'main-content@home': {templateUrl: 'welcome/content',controller:'regCtrl'},
                'footer@home': {templateUrl: 'welcome/footer'}
            }
        })

        .state('fbvoice', {
            parent: 'collection',
            url: '/fbvoice',
            views: {
                'main-content@collection': {templateUrl: 'welcome/fbvoice', controller : 'regCtrl'}
            }
        })


        .state('results', {
            url: '/results',
            views: {
                '': {templateUrl: 'welcome/home',controller: 'reportCtrl', abstract:true},
                'header@results': {templateUrl: 'welcome/header'},
                'sidebar@results': {templateUrl: 'welcome/sidebar'},
                'main-content@results': {templateUrl: 'welcome/reports',controller : 'adminCtrl'},
                'footer@results': {templateUrl: 'welcome/footer'}
            }
        })

        .state('qgroups', {
            parent: 'results',
            url: '/qgroups',
            views: {
                'main-content@results': {templateUrl: 'welcome/qgroups', controller : 'adminCtrl'}
            }
        })
        .state('qlists', {
            parent: 'results',
            url: '/qlists',
            views: {
                'main-content@results': {templateUrl: 'welcome/qlists', controller : 'adminCtrl'}
            }
        })
		.state('dashboard', {
            parent: 'results',
            url: '/dashboard',
            views: {
                'main-content@results': {templateUrl: 'welcome/dashboard',controller:'adminCtrl'}
            }
        })


}]);