/* 
 * File: createblog.js.js
 * 
 * Copyright © 2016 Terry Gilliver <terry@comp-solutions.org.uk> - Computer Solutions
 * 
 * Created: 02-Feb-2016 15:15:46
 * 
 * Purpose:
 * 
 * 
 * Modification History:
 * 
 */
$('li.active').removeClass('active');
$('li#admin').addClass('active');
// fade main div in and out
$('#mywrapper').fadeIn(1000);
$('a').not('.dd-selected').not('.dd-option').click(function (e) {
    e.preventDefault();
    var href = $(this).attr('href');
    $('#mywrapper').fadeOut(1000, function () {
        window.location = href;
    });
});


var validatorOptions = {
    delay: 100,
    custom: {
        blog: function ($el) {
            return ($el.val() !== "") ? true : false;
        }
    },
    errors: {
        blog: "Text Missing"
    }
};
$("#createblog").validator(validatorOptions);

$('#imageurl').ddslick({
    width: '100%',
    onSelected: function (data) {
        console.log("text: ",data.selectedData.text);
        console.log("value: ",data.selectedData.value);
        console.log("description: ",data.selectedData.description);
        console.log("imageSrc: ",data.selectedData.imageSrc);
        $filename = data.selectedData.imageSrc.split('/').pop();
        console.log("filename: ",$filename);
        $('#imagesrc').val($filename);
    }
});
