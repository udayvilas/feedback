/**
 * Created by uday on 19/03/2018.
 */

app.factory('ImportExportToExcel', function($http,$log,$q) {
    return {
        exportToMultipleSheets: function(fileName, targetData, options)
        {
            if (!angular.isArray(targetData)) {
                $log.error('Can not export to excel, data type error.');
                return;
            }
            if (!angular.isArray(options)) {
                $log.error('Can not export error, no valid options provided.');
                return;
            }
            var exportFileName = (fileName && fileName.trim().length > 0) ? fileName : new moment().format("x");
            alasql('SELECT INTO XLSX("' + exportFileName + '.xls",?) FROM ?', [options, targetData]);
        }
    }
});
