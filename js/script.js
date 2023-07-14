/**
 * Send links of class "delete" via post after a confirmation dialog
 */

$("a.delete").on("click", function(e){

    e.preventDefault();

    if (confirm("Are you sure you want to delete?")){

        var frm = $("<form>");
        frm.attr("method", "post");
        frm.attr("action", $(this).attr("href"));
        frm.appendTo("body");
        frm.submit();
    }
});


/**
 * Form validation
 * 
 * @date_published it accepts null, but if not null, it checks for the dateTime format to be valid
 */

$.validator.addMethod("dateTime", function(value, element){
    return (value == "") || !isNaN(Date.parse(value));
}, "Must be a valid date and time");

$("#formArticle").validate({
    rules: {
        title: {
            required: true
        },
        content: {
            required: true
        },
        date_published: {
            dateTime: true
        }
    }
});








