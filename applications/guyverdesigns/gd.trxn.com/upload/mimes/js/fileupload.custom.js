$(document).bind('dragover', function (e) {
    var dropZone = $('#dropzone'),
        timeout = window.dropZoneTimeout;
    if (!timeout) {
        dropZone.addClass('in');
    } else {
        clearTimeout(timeout);
    }
    var found = false,
        node = e.target;
    do {
        if (node === dropZone[0]) {
            found = true;
            break;
        }
        node = node.parentNode;
    } while (node != null);
    if (found) {
        dropZone.addClass('hover');
    } else {
        dropZone.removeClass('hover');
    }
    window.dropZoneTimeout = setTimeout(function () {
        window.dropZoneTimeout = null;
        dropZone.removeClass('in hover');
    }, 100);
});

$(function ()
	{
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = "/gd.trxn.com/upload/_controls/ajax/UPLOAD.php?GD_CONTROL_KEY=DEFAULT";
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        done: function (e, data) {
        	// alert("e {" + e +"}");
            $.each(data.result.FILE_UPLOAD_INFO.files, function (index, file) {
            	// alert("file {" + file + "}");
                var p = $('<p/>').text(file.name);
                p.prependTo('#gdupload_files');
                if(file.thumbnailUrl != null)
                {
                	// alert("src {" + file.thumbnailUrl.replace("\/", "/") + "}");
                    var img = $("<img/>").attr("src", file.thumbnailUrl.replace("\/", "/"));
                    img.prependTo(p);
                }
            });
        },
        progressall: function (e, data)
        {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            ).css("height","100%").css("background-color","blue");
            $("#gdupload_progress").html(progress + '%');
        }
    }
    ).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});