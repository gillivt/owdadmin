/* 
 * File: photo_upload.js
 * 
 * Copyright © 2016 Terry Gilliver <terry@comp-solutions.org.uk> - Computer Solutions
 * 
 * Created: 03-Feb-2016 13:52:18
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
            var pattern = new RegExp("^[A-Za-z0-9 ._-]+(.jpg|.png|.gif)$","i");
            var testResult = pattern.test(fileName);
            return testResult;
        }
    },
    errors : {
        image : "Not a Valid Image"
    }
};
$("#uploadimage").validator(validatorOptions);


// fade main div in and out
$('div#mywrapper').fadeIn(1000);
$('a').click(function(e){
    e.preventDefault();
    var href= $(this).attr('href');
    $('div#mywrapper').fadeOut(1000, function() {
        window.location=href;
    });
});
