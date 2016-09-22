/* 
 * File: findus.js
 * 
 * Copyright © 2016 Terry Gilliver <terry@comp-solutions.org.uk> - Computer Solutions
 * 
 * Created: 27-Jan-2016 02:43:36
 * 
 * Purpose:
 * 
 * 
 * Modification History:
 * 
 */

//set active page
$('li.active').removeClass('active');
$('li#findus').addClass('active');
// fade main div in and out
$('#mywrapper').fadeIn(1000);
$('a').click(function (e) {
    e.preventDefault();
    var href = $(this).attr('href');
    $('#mywrapper').fadeOut(1000, function () {
        window.location = href;
    });
});

$('#validate').validator().on('submit', function (e) {
    if (e.isDefaultPrevented()) {
        return;
    } else {
        event.preventDefault();
        var saddr = encodeURIComponent($("#saddr").val());
        var daddr = encodeURIComponent($("#daddr").val());
        $("#mapdata").html('<iframe width="650" height="400" frameborder="0" style="border:0;" src="https://www.google.com/maps/embed/v1/directions?key=AIzaSyCCgEE73_1IIk9xhTgDtF98DQ_KrfXZMso&origin=' + saddr + '&destination=' + daddr + '&mode=driving" allowfullscreen></iframe>');
    }
});
