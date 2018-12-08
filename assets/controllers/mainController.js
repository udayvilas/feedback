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
    $log.log("user id "+$cookies.get('exam_user_id'));


    if ($cookies.get('exam_user_id') == undefined || $cookies.get('exam_user_id') == "" || $cookies.get('exam_user_id') == null)
    {
        if (!$state.is("login"))
        {
            $state.go('login');
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

    $scope.user_id = $cookies.get('exam_user_id');
    $scope.user_name = $cookies.get('exam_user_name');
    $scope.user_role = $cookies.get('exam_role');
    $scope.unit_name = $cookies.get('exam_unit_name');
    $scope.qgroup = $cookies.get('exam_qgroup');
    $rootScope.registration_count = 0;
    $scope.submit_label = "";

    $scope.isActive = function(route) {
        //console.log("active path" +$location.path());
        return route === $location.path();
    }

    $scope.quest_list = [];
    $scope.current_quest = [];
    $scope.exam_data = {};
    $scope.current_index = 0;
    $scope.exam_stat = '';

    $scope.exam_questions = function()
    {
        var send = {"action":"get_exam_questions","qgroup":$scope.qgroup};
        baseFactory.examCtrl(send)
            .then(function (payload) {
                    // $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.quest_list = payload.list;
                        $scope.current_quest = $scope.quest_list[0];
                    }
                    else {
                        $scope.quest_list = [];
                        $scope.current_quest = [];
                    }

                },
                function (errorPayload) {
                    baseFactory.toastCtrl('error',"Something Went Wrong");
                    $log.error('failure loading', errorPayload);
                });
    }

    $scope.current_question = function(index)
    {
        $log.info("exam staus "+$scope.exam_stat);
        $log.info("current location "+index);

        $scope.current_index = index;
        $scope.current_quest = $scope.quest_list[index];
    }





}]);

