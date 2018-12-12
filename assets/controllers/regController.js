/**
 * Created by uday on 16/03/2018.
 */
app.controller('regCtrl',['$scope', '$state', '$timeout', '$http', '$rootScope', '$q', '$log','$window','baseFactory','$cookies','$filter','$mdDialog',
    function ($scope, $state, $timeout, $http, $rootScope, $q, $log,$window,baseFactory,$cookies,$filter,$mdDialog )
{

    $scope.user_id = $cookies.get('fb_user_id');
    $scope.user_name = $cookies.get('fb_user_name');
    $scope.user_role = $cookies.get('fb_role');
    $scope.unit_name = $cookies.get('fb_unit_name');


}]);
