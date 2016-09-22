/**
 *  File: resizemain.js
 * 
 *  Date: 11-Jul-2013
 *  Time: 11:15:21
 * 
 *  Author: Terry Gilliver
 *  
 *  Purpose:
 *  force main area to fit screen
 *  Modification History:
 *  
 */

$(document).ready(function () {
    var headerHeight = 52;
    $(window).resize(function () {
        $('main').css("height", ($(window).height() - headerHeight - 30) + "px");
    });
  
    $('main').css("height", ($(window).height() - headerHeight - 30) + "px");
});  
