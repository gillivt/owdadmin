/* 
 * File: photos.js
 * 
 * Copyright © 2016 Terry Gilliver <terry@comp-solutions.org.uk> - Computer Solutions
 * 
 * Created: 03-Feb-2016 15:50:17
 * 
 * Purpose:
 * 
 * 
 * Modification History:
 * 
 */
//set active page
$('li.active').removeClass('active');
$('li#gallery').addClass('active');

// fade main div in and out
$('div#mywrapper').fadeIn(1000);
$('a').click(function(e){
    e.preventDefault();
    var href= $(this).attr('href');
    $('div#mywrapper').fadeOut(1000, function() {
        window.location=href;
    });
});
