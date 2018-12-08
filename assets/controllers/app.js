/**
 * Created by uday on 16/02/2018.
 */
'use strict';

var app = angular.module('noe', ['ui.router','ngMaterial','ngMessages','ngCookies','ngAnimate','cl.paging','angular-page-loader']);
//,'ngSanitize'

app.run(function($timeout, $rootScope) {
    $timeout(function() { // simulate long page loading
        $rootScope.isLoading = false; // turn "off" the flag
    }, 3000)

})

app.filter('objLength', function() {
    return function(object) {
        var count = 0;

        for(var i in object){
            count++;
        }
        return count;
    }
});


app.filter('timer', function() {
    return function (time) {
        var sec_num = parseInt(time, 10); // don't forget the second param
        var hours   = Math.floor(sec_num / 3600);
        var minutes = Math.floor((sec_num - (hours * 3600)) / 60);
        var seconds = sec_num - (hours * 3600) - (minutes * 60);

        if (hours   < 10) {hours   = "0"+hours;}
        if (minutes < 10) {minutes = "0"+minutes;}
        if (seconds < 10) {seconds = "0"+seconds;}

        hours = (hours == '0-1') ? '00' : hours;
        var time    = hours+':'+minutes+':'+seconds;
        return time;
    }
});

