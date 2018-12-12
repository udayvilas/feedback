/**
 * Created by uday on 19/03/2018.
 */
app.controller('reportCtrl',['$scope', '$state', '$timeout', '$http', '$rootScope', '$q', '$log','$mdDialog','baseFactory','$cookies','$filter','ImportExportToExcel','$location',
    function ($scope, $state, $timeout, $http, $rootScope, $q, $log,$mdDialog,baseFactory,$cookies,$filter ,ImportExportToExcel,$location )
    {

        $log.log("I'm in report controller");

//        $rootScope.isLoading = true;
        $rootScope.successdata = "success";
        $rootScope.emptydata   = "empty";
        $rootScope.faileddata  = "failed";
        $scope.submit_label    = "Login";


        $log.log("user id "+$cookies.get('exam_user_id'));
        if ($cookies.get('exam_user_id') == undefined || $cookies.get('exam_user_id') == "" || $cookies.get('exam_user_id') == null)
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

        $scope.user_id = $cookies.get('exam_user_id');
        $scope.user_name = $cookies.get('exam_user_name');
        $scope.user_role = $cookies.get('exam_role');
        $scope.unit_name = $cookies.get('exam_unit_name');
        $scope.qgroup = $cookies.get('exam_qgroup');

		/********** sidebar active *************/
		  $scope.isActive = function(route) {
			// console.log("active path" +$location.path());
			return route === $location.path();
		}


        var curdt = new Date();
        $scope.home_src = {fromdt:$filter('date')(curdt,'dd-MMM-yyyy'),todt:$filter('date')(curdt,'dd-MMM-yyyy'), qgroup: $scope.qgroup, branch: 'All' };
        $scope.home_src.fromdt = new Date($scope.home_src.fromdt);
        $scope.home_src.todt = new Date($scope.home_src.todt);


        /****************************** pagination controller start ******************/


        $scope.currentPage = 0;
        $scope.paging = {
            total: 0,
            current: 1,
            limit:5
            //onPageChanged: loadPages
        };

        /*     function loadPages() {

         //$scope.currentPage = ($scope.currentPage == 0) ? 1 : $scope.currentPage;
         console.log('Current page is : ' + $scope.paging.current+" cru index "+ ($scope.currentPage - 1));

         // TODO : Load current page Data here
         var start = $scope.paging.current - 1;
         $scope.page_items = $scope.member_list.slice( start * 3 , $scope.paging.current * 3);
         $scope.currentPage = $scope.paging.current;

         $log.info($scope.paging);

         }
         */

        $scope.my_pages = function()
        {
            //$scope.currentPage = ($scope.currentPage == 0) ? 1 : $scope.currentPage;
            // console.log('Current page is : ' + $scope.paging.current+" cru index "+ ($scope.currentPage - 1));

            // TODO : Load current page Data here
            var start = ($scope.paging.current - 1) * $scope.paging.limit;
            var end = $scope.paging.current * $scope.paging.limit;
            $scope.page_items = $scope.member_list.slice( start , end );
            $scope.currentPage = $scope.paging.current;
            // $log.info($scope.paging);
        }


        /****************************** pagination controller end ******************/



        $scope.member_list = [];
        $scope.exam_reg_list = function()
        {
            var send = {"action":"reg_member_list",
                        "fromdt" : $scope.home_src.fromdt,
                        "todt" : $scope.home_src.todt,
                        qgroup : $scope.qgroup,
                        branch: $scope.home_src.branch
                    };
            //$log.log(JSON.stringify(send));
            baseFactory.reportCtrl(send)
                .then(function (payload) {
                        // $log.log(payload);
                        if (payload.response == $rootScope.successdata) {
                            $scope.member_list = payload.list;

                            //$log.log(JSON.stringify($scope.member_list));
                            $scope.no_of_recs = payload.list.length;
                            $scope.page_items = $scope.member_list.slice( 0 , $scope.paging.limit);
                            $scope.paging.total = Math.ceil($scope.no_of_recs / $scope.paging.limit);
                            $scope.paging.current = 1;
                        }
                        else {
                            $scope.paging.total = $scope.paging.current = $scope.no_of_recs = 0;
                            $scope.member_list = [];
                        }
                        $scope.currentPage = 0;
                    },
                    function (errorPayload) {
                        $log.error('failure loading', errorPayload);
                    });
        }


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

        $scope.add_edit='Add';
        $scope.group = {"qid":"", "name":"","status":""};
        $scope.add_qgroup = function()
        {
            var send = $scope.group;
            send.action =  "set_qgroup_data";
            send.user_id =  $scope.user_id;

            baseFactory.setupsCtrl(send)
                .then(function (payload) {
                        //$log.log(payload);
                        if (payload.response == $rootScope.successdata) {
                            if($scope.group.qid == '' )
                                baseFactory.toastCtrl("success","Q-Group Inserted Successfully");
                            else
                                baseFactory.toastCtrl("success","Q-Group Updated Successfully");

                            $scope.add_edit='Add';
                            $scope.group = {"qid":"", "name":"","status":""};
                            $scope.get_qgroups();
                        }
                        else {
                            baseFactory.toastCtrl("success","Q-Group Insertion Failed");
                        }
                    },
                    function (errorPayload) {
                        $log.error('failure loading', errorPayload);
                    });
        }

        $scope.edit_qgroup = function(list)
        {
            $scope.add_edit='Edit';
            $scope.group = {"qid":list.GROUP_ID, "name":list.GROUP_NAME,"status":list.STATUS};
        }

        $scope.reset = function(type)
        {
            if(type == "qgroup" )
            {
                $scope.add_edit='Add';
                $scope.group = {"qid":"", "name":"","status":""};
            }
        }


        $scope.current_quest = [];
        $scope.current_index = 0;
        $scope.quest_list = [];
        $scope.qgroup_data_list = function(qgroup)
        {
            if(qgroup == undefined)
            {
                baseFactory.toastCtrl("warning","Please Select Q-Group");
                return false;
            }

            var send = {action:"get_exam_questions", "qgroup": qgroup ,"callFrom" : "Admin" };
            baseFactory.examCtrl(send)
                .then(function (payload) {
                        //$log.log(payload);
                        if (payload.response == $rootScope.successdata) {
                            $scope.quest_list = payload.list;
                            $scope.current_quest = $scope.quest_list[$scope.current_index];
                        }
                        else {
                            $scope.quest_list = [];
                            $scope.current_quest = [];
                        }
                    },
                    function (errorPayload) {
                        $log.error('failure loading', errorPayload);
                    });
        }

        $scope.current_question = function(index)
        {
            $scope.current_index = index;
            $scope.current_quest = $scope.quest_list[index];
        }

        $scope.export_reg_list = function()
        {
            var data = new Array();
            data[0] = $scope.member_list;

            var options = [{
                sheetid: 'NPP Results',
                header: true
            }];

            ImportExportToExcel.exportToMultipleSheets( "NPP Results" , data , options );
        }


        $scope.showConfirm = function(quest,ev) {
            console.clear();
            // Appending dialog to document.body to cover sidenav in docs app
            var confirm = $mdDialog.confirm(quest)
                .title('Would you like to delete this Question?')
                .textContent('Qus. '+quest.Q_DESC)
                .ariaLabel('Lucky day')
                .targetEvent(ev)
                .ok('Yes do it!')
                .cancel('Cancel');

            $mdDialog.show(confirm).then(function(quest) {

                $log.log(JSON.stringify(quest));

              /*  var send = $scope.quest;
                send.action = "del_question";

                $log.log(JSON.stringify(send));

                baseFactory.setupsCtrl(send)
                    .then(function (payload) {
                            $log.log(payload);
                            if (payload.response == $rootScope.successdata) {
                                baseFactory.toastCtrl("success","Question Added Successfully");
                            }
                            else {
                                baseFactory.toastCtrl("error","Something Went Wrong");
                            }
                            $mdDialog.hide();
                        },
                        function (errorPayload) {
                            $log.error('failure loading', errorPayload);
                        });
                */
                $log.log("yes");

            }, function() {
                $log.log("No");

            });
        };

        $scope.customFullscreen = false;
        $scope.addQuestion = function(ev) {
            $mdDialog.show({
                controller: questCtrl,
                templateUrl: 'welcome/addquestion',
                parent: angular.element(document.body),
                targetEvent: ev,
                clickOutsideToClose:true,
                scope: $scope,        // use parent scope in template
                preserveScope: true,  // do not forget this if use parent scope
                locals : { quest : '' },
                fullscreen: $scope.customFullscreen // Only for -xs, -sm breakpoints.
            })
                .then(function(answer) {
                    $scope.status = 'You said the information was "' + answer + '".';
                }, function() {
                    $scope.status = 'You cancelled the dialog.';
                });
        };

        $scope.editQuestion = function(quest,ev) {
            $mdDialog.show({
                controller: questCtrl,
                templateUrl: 'welcome/addquestion',
                parent: angular.element(document.body),
                targetEvent: ev,
                clickOutsideToClose:true,
                scope: $scope,        // use parent scope in template
                preserveScope: true,  // do not forget this if use parent scope
                locals : { quest : quest },
                fullscreen: $scope.customFullscreen // Only for -xs, -sm breakpoints.
            })
                .then(function(answer) {
                    $scope.status = 'You said the information was "' + answer + '".';
                }, function() {
                    $scope.status = 'You cancelled the dialog.';
                });
        };

        function questCtrl($scope, $mdDialog, quest) {

            if(quest == '')
                $scope.quest = {"q_id":'', "qst_desc":'', "optlength":1, "opt_arr":[], "answer":'',"group":''};
            else
                $scope.quest = {
                    "q_id": quest.Q_ID,
                    "qst_desc": quest.Q_DESC,
                    "optlength": parseFloat(quest.MAX_OPT),
                    "opt_arr": quest.OPT_ARR,
                    "answer": parseFloat(quest.ANS),
                    "group": quest.Q_GROUP
                };

            $scope.addQuest = function()
            {
                var send = $scope.quest;
                send.action = "operate_question";
                //$log.log(JSON.stringify(send));

                baseFactory.setupsCtrl(send)
                    .then(function (payload) {
                            //$log.log(payload);
                            if (payload.response == $rootScope.successdata) {
                                if(send.q_id == '')
                                    baseFactory.toastCtrl("success","Question Added Successfully");
                                else
                                    baseFactory.toastCtrl("success","Question Updated Successfully");

                                $scope.qgroup_data_list(send.group);
                            }
                            else {
                                baseFactory.toastCtrl("error","Something Went Wrong");
                            }
                            $mdDialog.hide();
                        },
                        function (errorPayload) {
                            $log.error('failure loading', errorPayload);
                        });
            }

            $scope.hide = function() {
                $mdDialog.hide();
            };

            $scope.cancel = function() {
                $mdDialog.cancel();
            };

            $scope.answer = function(answer) {
                $mdDialog.hide(answer);
            };
        }

        $scope.units_list = [];
        $scope.loadBranchs = function()
        {
            var send = {action: "loadbranchs"}
            baseFactory.reportCtrl(send)
                .then(function (payload) {
                        //$log.log(payload);
                        if (payload.response == $rootScope.successdata) {
                            $scope.units_list = payload.list;
                        }
                        else {
                            $scope.units_list = [];
                        }
                    },
                    function (errorPayload) {
                        $log.error('failure loading', errorPayload);
                    });
        }

        $scope.current_dept = 'All';
        $scope.total_reg = 0;
        $scope.current_unit = 'All Units';
        $scope.current_unit_code = 'All';
        $scope.no_of_reg = function()
        {
            var send = {action: "no_of_reg","branch": $scope.current_unit_code , "dept":$scope.current_dept}
            baseFactory.reportCtrl(send)
                .then(function (payload) {
                        //$log.log(payload);
                        if (payload.response == $rootScope.successdata) {
                            $scope.units_list = payload.list;
                            $scope.total_reg = payload.total_reg;
                        }
                        else {
                            $scope.units_list = [];
                        }
                    },
                    function (errorPayload) {
                        $log.error('failure loading', errorPayload);
                    });

        }

        $scope.gender_data = [];
        $scope.gender_cal = function()
        {
            $log.info("gender call");
            var send = {action: "gender_cal", "branch": $scope.current_unit_code , "dept":$scope.current_dept};
            baseFactory.reportCtrl(send)
                .then(function (payload) {
                        //$log.log(payload);
                        if (payload.response == $rootScope.successdata) {
                            $scope.gender_data = payload.list;
                            $scope.gender_chart();
                        }
                        else {
                            $scope.gender_data = [];
                        }
                    },
                    function (errorPayload) {
                        $log.error('failure loading', errorPayload);
                    });
        }

        $scope.merit_list = [];
        $scope.merit_cal = function()
        {
            var send = {action: "merit_cal", "branch": $scope.current_unit_code , "dept":$scope.current_dept};
            baseFactory.reportCtrl(send)
                .then(function (payload) {
                        //$log.log(payload);
                        if (payload.response == $rootScope.successdata) {
                            $scope.merit_list = payload.list;
                            $scope.merit_chart();
                        }
                        else {
                            $scope.merit_list = [];
                        }
                    },
                    function (errorPayload) {
                        $log.error('failure loading', errorPayload);
                    });
        }






        $scope.change_unit = function(index)
        {
            for(var i = 0; i < $scope.units_list.length; i++)
            {
                if(index != i)
                    $scope.units_list[i]['active'] = false;
                else{
                    $scope.current_unit = $scope.units_list[index]['BRANCH_NAME'];
                    $scope.current_unit_code = $scope.units_list[index]['BRANCH_ID'];
                    $scope.units_list[index]['active'] = true;
                }
            }

            $scope.no_of_reg();
            $scope.gender_cal();
            $scope.merit_cal();
        }




	/************************  Charts *****************************/

    $scope.gender_chart = function()
    {

// Create the chart
        Highcharts.chart('gender', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Gender Chart'
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'Total percent marks'
                }

            },
            legend: {
                enabled: false
            },
            credits: {
                enabled: false
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        format: '{point.y:.1f}%'
                    }
                }
            },

            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
            },
            "series": [
                {
                    "name": "Gender",
                    "colorByPoint": true,
                    "data": $scope.gender_data
                }
            ]
        });
    }

	$scope.merit_chart = function()
	{
	    /************************** Merit Chart *******************/
		var pieColors = (function () {
			var colors = [],
				base = Highcharts.getOptions().colors[0],
				i;

			for (i = 0; i < 10; i += 1) {
				// Start out with a darkened base color (negative brighten), and end
				// up with a much brighter color
				colors.push(Highcharts.Color(base).brighten((i - 3) / 7).get());
			}
			return colors;
		}());
	
			Highcharts.chart('passed', {
				chart: {
					plotBackgroundColor: null,
					plotBorderWidth: null,
					plotShadow: false,
					type: 'pie'
				},
				title: {
					text: 'Merit Chart'
				},
				tooltip: {
					pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
				},
                credits: {
                    enabled: false
                },
				plotOptions: {
					pie: {
						allowPointSelect: true,
						cursor: 'pointer',
						colors: pieColors,
						dataLabels: {
							enabled: true,
							format: '<b>{point.name}</b><br>{point.percentage:.1f} %',
							distance: -50,
							filter: {
								property: 'percentage',
								operator: '>',
								value: 4
							}
						}
					}
				},
				series: [{
					name: 'Grade',
					data: $scope.merit_list
				}]

			});
	}
		
}]);




