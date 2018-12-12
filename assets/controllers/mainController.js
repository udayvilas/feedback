/**
 * Created by uday on 08/02/2018.
 */
app.controller('mainCtrl',['$scope', '$state', '$timeout', '$http', '$rootScope', '$q', '$log','$window','baseFactory','$cookies','$filter','$mdDialog','$anchorScroll','$location', '$interval', function ($scope, $state, $timeout, $http, $rootScope, $q, $log,$window,baseFactory,$cookies,$filter,$mdDialog,$anchorScroll, $location, $interval)
{
    //$rootScope.isLoading = true;
    $rootScope.successdata = "success";
    $rootScope.emptydata   = "empty";
    $rootScope.faileddata  = "failed";
    $scope.submit_label    = "Login";

    $log.log("I'm in main Controller");
    $log.log("user id "+$cookies.get('fb_user_id'));


    if ($cookies.get('fb_user_id') == undefined || $cookies.get('fb_user_id') == "" || $cookies.get('fb_user_id') == null)
    {
        if (!$state.is("login"))
        {
            //$state.go('login');
        }
    }

    $scope.logout = function () {

        $log.log("logout stated");
        var cookies = $cookies.getAll();
        angular.forEach(cookies, function (v, k) {
            $cookies.remove(k);
        });
        window.location.href = "auth/logout";
        baseFactory.toastCtrl('success','Logout Success, Login Again!');
    };

    $scope.user_id = $cookies.get('fb_user_id');
    $scope.user_name = $cookies.get('fb_user_name');
    $scope.user_role = $cookies.get('fb_role');
    $scope.unit_name = $cookies.get('fb_unit_name');

    $scope.isActive = function(route) {
        //console.log("active path" +$location.path());
        return route === $location.path();
    }



}]);

