/**
 * Created by uday on 03/03/2018.
 */

app.directive('fileModel', ['$parse', function ($parse)
{
    return {
        restrict: 'A',
        link: function(scope, element, attrs) {
            var model = $parse(attrs.fileModel);
            var isMultiple = attrs.multiple;
            var modelSetter = model.assign;
            element.bind('change', function()
            {
                var values = [];
                angular.forEach(element[0].files, function (item) {
                    var value = {
                        // File Name
                        name: item.name,
                        //File Size
                        size: item.size,
                        //File URL to view
                        url: URL.createObjectURL(item),
                        // File Input Value
                        _file: item
                    };
                    values.push(value);
                });
                scope.$apply(function () {
                    if (isMultiple) {
                        modelSetter(scope, values);
                    } else {
                        modelSetter(scope, values[0]);
                    }
                });
            });
        }
    };
}])

app.directive('ngRepeatRange', ['$compile', function ($compile) {
    return {
        replace: true,
        scope: { from: '=', to: '=', step: '=' },

        link: function (scope, element, attrs) {

            // returns an array with the range of numbers
            // you can use _.range instead if you use underscore
            function range(from, to, step) {
                var array = [];
                while (from + step <= to)
                    array[array.length] = from += step;

                return array;
            }

            // prepare range options
            var from = scope.from || 0;
            var step = scope.step || 1;
            var to   = scope.to || attrs.ngRepeatRange;

            // get range of numbers, convert to the string and add ng-repeat
            var rangeString = range(from, to + 1, step).join(',');
            angular.element(element).attr('ng-repeat', 'n in [' + rangeString + ']');
            angular.element(element).removeAttr('ng-repeat-range');

            $compile(element)(scope);
        }
    };
}]);
