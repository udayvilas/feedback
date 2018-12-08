/**
 * Created by uday on 16/03/2018.
 */
app.controller('regCtrl',['$scope', '$state', '$timeout', '$http', '$rootScope', '$q', '$log','$window','baseFactory','$cookies','$filter','$mdDialog',
    function ($scope, $state, $timeout, $http, $rootScope, $q, $log,$window,baseFactory,$cookies,$filter,$mdDialog )
{

    $scope.user_id = $cookies.get('exam_user_id');
    $scope.user_name = $cookies.get('exam_user_name');
    $scope.user_role = $cookies.get('exam_role');
    $scope.group_name = $cookies.get('exam_group_name');
    $scope.exam_branch = $cookies.get('exam_branch');

    $scope.exam_stat = '';

    //timer with timeout
    $scope.stop_watch = 1800; // Total exam time 30 min
    $scope.start_exam = function() {

        if($cookies.get('exam_time') != '' )
        {
            $scope.stop_watch = $cookies.get('exam_time');
        }
        else
            $scope.stop_watch = 1800; // Total exam time 30 min
 

        $scope.exam_stat = 'S';
        $log.log("start the exam "+$scope.exam_stat);
        if($scope.myTimeout){
            $timeout.cancel($scope.myTimeout);
        }
        $scope.onTimeout = function(){
            $scope.stop_watch--;

            $cookies.put('exam_time', $scope.stop_watch);

            if($scope.exam_stat != 'C')
            {
                if($scope.stop_watch == 0 )
                    $scope.stop_exam();
                else
                    $scope.myTimeout = $timeout($scope.onTimeout,1000);
            }
        }
        $scope.myTimeout = $timeout($scope.onTimeout,1000);
    };

    $scope.resetTimerWithTimeout = function(){
        $scope.stop_watch = 0;
        $timeout.cancel($scope.myTimeout);
    }

    if($state.is('home'))
        $scope.exam_questions();


    if($cookies.get('exam_time') != '' )
    {
        $log.log("exam_time "+$cookies.get('exam_time'));
        $scope.start_exam();
    }

    if($scope.quest_list.length > 0 )
        $scope.current_quest = $scope.quest_list[0];

    $scope.stop_exam = function()
    {
        $log.log("stop the exam");
        $scope.exam_stat = 'P';
        $scope.stay_exam();
    }


    $scope.stay_exam = function()
    {
        $log.log("stay the exam");

        $scope.submit_exam('N');

        $scope.stop_watch = 120;
        if($scope.myTimeout){
            $timeout.cancel($scope.myTimeout);
        }
        $scope.onTimeout = function(){
            $scope.stop_watch--;

            $cookies.put('exam_time',$scope.stop_watch );
            if($scope.exam_stat != 'C')
            {
                if($scope.stop_watch == 0 )
                    $scope.close_exam();
                else
				{
					if($scope.stop_watch == 300)
						baseFactory.toastCtrl('warning',"You have 5mins left.");
					
                    $scope.myTimeout = $timeout($scope.onTimeout,1000);
				}
            }
        }
        $scope.myTimeout = $timeout($scope.onTimeout,1000);
    }

    $scope.results = {"currect_ans":0,"wrong_ans": 0,"marks": 0,"percent": 0};
    $scope.submit_exam = function(stat)
    {
        $log.log("submited the exam "+$scope.exam_stat);
        //$log.log(JSON.stringify($scope.exam_data));

        var ans_list = new Array();
        var indexdata = [];
        var k = 0;
        $scope.results.currect_ans = 0;
        $scope.results.wrong_ans = 0;

        for (var key in $scope.exam_data)
        {
            indexdata = $filter('filter')($scope.quest_list, {Q_ID: key})[0];
            // $log.info(indexdata['ANS']+"  "+$scope.exam_data[key]);
            if(indexdata['ANS'] == $scope.exam_data[key])
                $scope.results.currect_ans++;
            else
                $scope.results.wrong_ans++

            ans_list[k] = {
                value:$scope.exam_data[key],
                q_id: indexdata['Q_ID'],
                type : indexdata['Q_TYPE']
            };
            k++;
        }

        $scope.results.percent = ($scope.results.currect_ans / $scope.quest_list.length) * 100;

        var send = {"action":"save_exam",
                    "exam_data":ans_list,
                    "user_id":$scope.user_id,
                    "currect_ans":$scope.results.currect_ans,
                    "wrong_ans": $scope.results.wrong_ans,
                    "marks": $scope.results.currect_ans,
                    "percent": $scope.results.percent,
                    "total_quest" : $scope.quest_list.length,
                    "qgroup": $scope.qgroup,
                    "exam_branch" : $scope.exam_branch
                    };

        //$log.log(send);
        // return false;

        baseFactory.examCtrl(send)
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        if(stat == 'Y')
                            $scope.close_exam();
                    }
                    else {
                       baseFactory.toastCtrl('error',"Something Went Wrong");
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });

    }

    $scope.close_exam = function()
    {
        $cookies.put('exam_time', '');
        $scope.exam_stat = 'C';
        $scope.exam_time = 0;

        $timeout($scope.logout,60000);
    }




}]);
