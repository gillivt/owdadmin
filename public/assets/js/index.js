/* 
 * File: index.js
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
// image upload validation
var validatorOptions = {
    delay : 100,
    custom : {
        image : function($el) {
            var filePath = $el.val().trim();
            var fileName = filePath.replace(/^.*[\\\/]/, '');
            var pattern = new RegExp("^[A-Za-z0-9 ._-]+(.csv)$","i");
            //var pattern = new RegExp("^instructor.csv$");
            var testResult = pattern.test(fileName);
            return testResult;
        }
    },
    errors : {
        image : "Not a Valid CSV"
    }
};


$("#uploadinstructors").validator(validatorOptions);
$("#uploadcourses").validator(validatorOptions);

$('li.active').removeClass('active');
$('li#index').addClass('active');

// fade main div in and out
$('div#mywrapper').fadeIn(1000);
$('a').click(function(e){
    e.preventDefault();
    var href= $(this).attr('href');
    $('div#mywrapper').fadeOut(1000, function() {
        window.location=href;
    });
});