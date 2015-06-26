$(document).ready(function()
{
	var attr = "{" +
	""
			"}";
});

function gdSetUpUloadForm()
{
	//elements
	var progressbox     = $("#GDUploadProgressBox");
	var progressbar     = $("#GDUploadProgressBar");
	var statustxt       = $("#GDUploadProgressBarStatusTxt");
	var submitbutton    = $("#GDUploadSubmitButton");
	var myform          = $("#GDUploadForm");
	var output          = $("#TransactionErr");
	var completed       = "0%";
	var message         = "";
	
	$(myform).ajaxForm({
	    data: { GD_CONTROL_KEY: "REGISTER_WALL_MESSAGE" },
	    beforeSend: function()
	    {
	        submitbutton.attr("disabled", ""); // disable upload button
	        statustxt.empty();
	        progressbox.show(); //show progress bar
	        progressbar.width(completed); //initial value 0% of progress bar
	        statustxt.html(completed); //set status text
	        statustxt.css("color","#000"); //initial color of status text
	        message = "";
	        output.text(message);
	        clearOutputResults();
	    },
	    uploadProgress: function(event, position, total, percentComplete)
	    {
	    	// update progress bar percent complete
	        progressbar.width(percentComplete + "%");
	        // update status text
	        statustxt.html(percentComplete + "%");
	        if(percentComplete  >50)
	        {
	            statustxt.css("color","#fff"); //change status text to white after 50%
	        }
	    },
	    complete: function(data)
	    {
	    	// update element with received data
	        // output.html(response.responseText);
	    	// enable submit button*
	        submitbutton.removeAttr("disabled");
	        // hide progress bar
	        progressbox.hide();
	        data = eval('(' + data.responseText + ')');
	        if(buildContentBlockReturnMessage(data, "SUCCESS", "WallMessageTransactionOutput"))
	        {
	            gdLoadNewWallMessages();
	        }
	        myform.resetForm();  // reset form
	    }
	});
}