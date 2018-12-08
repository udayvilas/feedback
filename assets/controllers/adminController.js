/**
 * Created by uday on 29/03/2018.
 */

app.controller('adminCtrl',['$scope', '$state','$log', function ($scope, $state ,$log)
    {


        if($state.is('results'))
        {
            $scope.no_of_reg();
            $scope.exam_reg_list();
        }
        else if($state.is('dashboard'))
        {
            //$scope.loadBranchs();
            $scope.no_of_reg();
            $scope.gender_cal();
            $scope.merit_cal();
        }


}]);