$(function ()
{
    'use strict';
	var url = "http://www.seemeu.lcl/_controls/SERVICE.php?SERVICE_CONTROL_KEY=MIME_UPLOAD";
	
	$('#fileupload').fileupload(
	{
	    url: url,
	    dataType: 'json',
	    autoUpload: false,
	    acceptFileTypes: /(\.|\/)(gif|jpe?g|png|wmv)$/i,
	    // maxFileSize: 999000,
	    // Enable image resizing, except for Android and Opera,
	    // which actually support image resizing, but fail to
	    // send Blob objects via XHR requests:
	    disableImageResize: /Android(?!.*Chrome)|Opera/.test(window.navigator.userAgent),
	    previewMaxWidth: 500,
	    previewMaxHeight: 500,
	    // previewCrop: true
	})
	.on('fileuploadprocessalways', function (e, data)
	{
        var index = data.index;
        var file = data.files[index];
        if (file.preview)
        {
        	$("#upload_preview").empty();
        	$("#upload_preview").append(
    			$("<div/>").css("margin","auto")
				.css("height",file.preview.height)
				.css("width",file.preview.width)
				.css("position","relative")
				.css("top","50%")
				.css("transform","translateY(-50%)")
				.css("border","0px solid red").append(file.preview)
        		);

       	 	$('#upload_progress .progress-bar').css('width','0%');

            if (index + 1 === data.files.length) {
            	$("#upload_button")
                    .text('Upload')
                    .prop('disabled', !!data.files.error)
                    .data(data);
            }
        }
        if (file.error)
        {
        	$("#row_upload_messageline")
        		.append($("<span/>").text(file.error))
        		.toggle("hidden");
        }
	})
	.on('fileuploadprogressall', function (e, data)
	{
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#upload_progress .progress-bar').css('width',progress + '%');
	});
	
	$("#upload_button")
		.addClass('btn btn-primary')
		.prop('disabled', true)
		.text('Add Files...')
		.on('click', function () {
		    var $this = $(this),
		        data = $this.data();
		    $this
			.prop('disabled', true)
			.text('Uploading...');
		    alert("submit()");
		    /*
		    data.submit().always(function ()
			{
		        $this
		    	.prop('disabled', true)
		    	.text('File Uploaded');
		    });
		    */
	});
});