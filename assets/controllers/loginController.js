/**
 * Created by uday on 08/02/2018.
 */
app.controller('loginCtrl',['$scope', '$state', '$timeout', '$http', '$rootScope', '$q','$log','$window','baseFactory','$cookies','$filter', function ($scope, $state, $timeout, $http, $rootScope, $q, $log,$window,baseFactory,$cookies,$filter)
{
    $rootScope.isLoading = true;
    $rootScope.successdata = "success";
    $rootScope.emptydata   = "empty";
    $rootScope.faileddata  = "failed";
    $scope.newaction       = 'Login';
    $scope.submit_label    = 'Signup';

    $log.log("i'm in login Controller");
    $log.log("user_id "+$cookies.get('fb_user_id'));

    if ($cookies.get('fb_user_id') == undefined || $cookies.get('fb_user_id') == "" || $cookies.get('fb_user_id') == null)
    {
        if (!$state.is("login"))
        {
            //$state.go('login');
        }
    }
    else {
        /*
        var send = {action: "check_session_exists"};
        baseFactory.UserCtrl(send)
            .then(function (payload) {
                    //$log.log(payload);
                    if (payload.response == $rootScope.faileddata) {
                        baseFactory.toastCtrl('error','Session Expired, Logging Out!...')
                        $timeout(function () {
                            $scope.logout();
                        }, 3000);
                    }
                    else {
                        if ($state.is("login"))
                            $state.go('home');
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });*/
    }

    $scope.logout = function () {
        var cookies = $cookies.getAll();
        angular.forEach(cookies, function (v, k) {
            $cookies.remove(k);
        });
        window.location.href = "auth/logout";
        baseFactory.toastCtrl('success','Logout Success, Login Again!');
    };

    $scope.qgroup_list = [];
    $scope.get_qgroups = function()
    {
        var send = {"action":"fetch_qgroup_data"};
        baseFactory.setupsCtrl(send)
            .then(function (payload) {
                    //$log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.qgroup_list = payload.list;
                    }
                    else {
                        $scope.qgroup_list = [];
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    }
    $scope.get_qgroups();


    $scope.changeaction = function()
    {
        $log.log("in changeaction : "+$scope.newaction);
        if($scope.newaction == 'Signup')
        {
            $scope.submit_label = 'Signup';
            $scope.newaction = 'Login';
        }
        else
        {
            $scope.submit_label = 'Login';
            $scope.newaction = 'Signup';
        }
    }

    $scope.auth = {uname: '', gender: '', qualify: '', exp : '',email : '', user_id:'',pswd:'',qgroup:''};
    $scope.logincheck = function()
    {

        $state.go('home');
        return true;
        var send = $scope.auth;
        send.action = $scope.submit_label;
        $log.log("action "+send.action);
        $log.log(JSON.stringify(send));

        baseFactory.UserCtrl(send)
            .then(function(payload)
                {
                    $log.log(payload);
                    if(payload.response==$rootScope.successdata)
                    {
                        if($scope.submit_label == 'Login')
                        {
                            var group_name = $filter('filter')($scope.qgroup_list, {GROUP_ID: $scope.auth.qgroup})[0].GROUP_NAME;
                            $scope.login_app(payload.list,'set',group_name);
                        }
                        else if($scope.submit_label == 'Signup')
                        {
                            $scope.submit_label = 'Login';
                            baseFactory.toastCtrl('success','Registration Successfull, Please Login With Registered MailID ');
                        }
                    }
                    else if(payload.response==$rootScope.emptydata)
                    {
                        baseFactory.toastCtrl('success',payload.status);
                    }
                    else if(payload.response==$rootScope.faileddata)
                    {
                        baseFactory.toastCtrl('error',payload.status);
                    }

                },
                function(errorPayload)
                {
                    baseFactory.toastCtrl('error',"Something Went Wrong");
                    $scope.submit_label = "Login";

                    $log.error('failure loading', errorPayload);
                });

    }

    $scope.validate_user = function()
    {
        if($scope.submit_label == 'Signup')
            var send = {userid: $scope.auth.email ,action : 'validate_user'};
        else if($scope.submit_label == 'Login')
            var send = {userid: $scope.auth.user_id ,action : 'validate_user'};

        $log.log(send);
        baseFactory.UserCtrl(send)
            .then(function(payload)
                {
                    $log.log(payload);
                    if($scope.submit_label == 'Signup') {
                        if(payload.response==$rootScope.successdata)
                            return true;
                        else{
                            $scope.auth.email = '';
                            baseFactory.toastCtrl('error',"Email Id Already Exists");
                            return false;
                        }
                    }
                    else if($scope.submit_label == 'Login')
                    {
                        if(payload.response==$rootScope.successdata)
                        {
                            $scope.auth.user_id = '';
                            baseFactory.toastCtrl('error',"Invalid UserID");
                            return false;
                        }
                        else
                            return true;
                    }
                },
                function(errorPayload)
                {
                    baseFactory.toastCtrl('error',"Something Went Wrong");
                    $log.error('failure loading', errorPayload);
                });
    }

    $scope.login_app = function(keys,type,group_name)
    {
        if(type == 'set') {
            $cookies.put('fb_user_name', keys.USER_NAME);
            $cookies.put('fb_user_id', keys.USER_ID);
            $cookies.put('fb_role', keys.IS_ADMIN);
            $cookies.put('fb_branch',keys.UNIT_ID);

            $log.log(keys.IS_ADMIN);
            if(keys.IS_ADMIN == 'N')
                $state.go('home');
            else
                $state.go('dashboard');
        }
        else
        {

        }
    }


}]);

