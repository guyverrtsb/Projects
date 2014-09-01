$(document).ready(function()
{
//elements
    var progressbox     = $("#GDUploadProgressBox");
    var progressbar     = $("#GDUploadProgressBar");
    var statustxt       = $("#GDUploadProgressBarStatusTxt");
    var submitbutton    = $("#GDUploadSubmitButton");
    var myform          = $("#GDUploadMimeFrm");
    var output          = $("#GDTransactionOutput");
    var completed       = "0%";
    var message         = "&nbsp;";

	myform.attr("action", "/_controls/ajax/lfu/GD_UPLOAD_MIME.php");
    
    $(myform).ajaxForm({
        data: { "GD_CONTROL_KEY" : "UPLOAD_LARGE_FILE" },
        beforeSend: function() { //before sending form
            submitbutton.attr("disabled", ""); // disable upload button
            statustxt.empty();
            progressbox.show(); //show progress bar
            progressbar.width(completed); //initial value 0% of progress bar
            statustxt.html(completed); //set status text
            statustxt.css("color","#000"); //initial color of status text
            message = "&nbsp;";
            output.html(message);
            clearOutputResults();
        },
        uploadProgress: function(event, position, total, percentComplete) { //on progress
            progressbar.width(percentComplete + "%") //update progress bar percent complete
            statustxt.html(percentComplete + "%"); //update status text
            if(percentComplete>50)
                {
                    statustxt.css("color","#fff"); //change status text to white after 50%
                }
            },
        complete: function(data)
        { // on complete
            //output.html(response.responseText); //update element with received data
            submitbutton.removeAttr("disabled"); //enable submit button
            progressbox.hide(); // hide progress bar
            data = eval('(' + data.responseText + ')')
            if(buildContentBlockReturnMessage(data, "SUCCESS"))
            {
                // gdLoadNewWallMessages();
            }
            myform.resetForm();  // reset form
        }
    });
});

function clearOutputResults()
{
    //$("#GDUploadImage").text("");
    //$("#GDUploadReturnMessage").text("");
}