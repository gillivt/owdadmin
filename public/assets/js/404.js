/* 
 * File: 404.js
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
$('li#index').addClass('active');

// fade main div in and out
$('#mywrapper').fadeIn(1000);
$('a').click(function(e){
    e.preventDefault();
    var href= $(this).attr('href');
    $('#mywrapper').fadeOut(1000, function() {
        window.location=href;
    });
});