/*
––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
 Construction, Architecture & Building Company Template 
––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––

    - File           : main.js
    - Desc           : Theme Template - JavaScript
    - Date           : 02-04-2017
    - Author         : CODASTROID
    - Author URI     : https://themeforest.net/user/codastroid
    - Email          : codastroid@gmail.com

––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
*/

var countdown = function () {
    'use strict';
    var cdSelector =  $('#countdown');
    if (cdSelector.length) {} {

        /* January is 0, February is 1 ... */
        var launch_date = new Date(Date.UTC(2017, 7, 1, 0, 0)),
        days, hours, minutes, seconds, rest, counterHtml,
        now = new Date(),
        twoDigit = function(n) {
            return (n < 10 ? '0' : false) + n;
        };

        seconds = rest = Math.floor(((launch_date.getTime() - now.getTime()) / 1000));
        days = twoDigit(Math.floor(seconds / 86400));
        seconds -= days * 86400;
        hours = twoDigit(Math.floor(seconds / 3600));
        seconds -= hours * 3600;
        minutes = twoDigit(Math.floor(seconds / 60));
        seconds -= minutes * 60;
        seconds = twoDigit(Math.floor(seconds));

        rest <= 0 ? days = hours = minutes = seconds = '00' : setTimeout(countdown, 1000);

        counterHtml = '<li><h1 class="font-40">' + days + '</h1><h5 class="t-uppercase"> day' + (days > 1 ? 's' : '') + '</h5></li>';
        counterHtml += '<li><h1 class="font-40">' + hours + '</h1><h5 class="t-uppercase"> hour' + (hours > 1 ? 's' : '') + '</h5></li>';
        counterHtml += '<li><h1 class="font-40">' + minutes + '</h1><h5 class="t-uppercase"> minute' + (minutes > 1 ? 's' : '') + '</h5></li>';
        counterHtml += '<li><h1 class="font-40">' + seconds + '</h1><h5 class="t-uppercase"> day' + (seconds > 1 ? 's' : '') + '</h5></li>';
        cdSelector.html(counterHtml);

    }
};


/* ====================================
   When document is ready, do
==================================== */
$(document).on('ready', function() {
    countdown();
});

