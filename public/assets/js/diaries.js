/* 
 * File: diaries.js
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
$('li.active').removeClass('active');
$('li#diaries').addClass('active');

// fade main div in and out
$('div#mywrapper').fadeIn(1000);
$('a').click(function(e){
    e.preventDefault();
    var id = $(this).attr('id');
    switch (id) {
        case 'viewinstructordiary':
            $('#result').load('viewinstructordiary.php');
            break;
        default:
            var href= $(this).attr('href');
            $('div#mywrapper').fadeOut(1000, function() {
                window.location=href;
            });
    }  
});
