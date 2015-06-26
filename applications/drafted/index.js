$(document).ready(function()
{
    $.post("/_controls/SERVICE.php",
		{
			SERVICE_CONTROL_KEY : "APP_CONFIGURATIONS-GET_GROUPKEY_ITEMS",
			groupkey : "USER_TYPE"
		},
		function(data)
	    {
	    	data = eval("(" + data + ")");
	    	gdCarouselBuildHeadline(data.RETRIEVEAPPCONFIGURATION);
	    });
    $.post("/_controls/SERVICE.php",
		{
			SERVICE_CONTROL_KEY : "APP_CONFIGURATIONS-GET_GROUPKEY_ITEMS",
			groupkey : "GROUP_TYPE"
		},
		function(data)
	    {
	    	data = eval("(" + data + ")");
	    	gdCarouselFeaturette(data.RETRIEVEAPPCONFIGURATION);
	    });
});

/*
 * Builds the column rows
 * numPerRow = (1, 2 ,3 ,4, 6, 12)
 * jsonObj = JSON Object
 */
function gdCarouselBuildHeadline(data, numPerRow)
{
	/*
<div class="row">
<div class="col-lg-4">
<img class="img-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
<h2>Links</h2>
<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
<p id="gdsyslinksButton"><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
</div>
	 */
	if(numPerRow === undefined || numPerRow < 1 || numPerRow > 12 || numPerRow == 5 || numPerRow > 6)
		numPerRow = 3;
	var counter = 0; 
	var cellspan = Math.ceil(12 / numPerRow);
	var div_row = null;
    $.each(data, function(key, val)
    {
    	if(counter == 0)
    		div_row = $("<div/>").addClass("row");
    	
    	var div_col = $("<div/>").addClass("col-lg-" + cellspan);
    	var img = $("<img/>",
			{
				src: "data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==",
				alt: "Generic placeholder image",
				width: "140",
				height: "140"
			}).addClass("img-circle");
    	var h2 = $("<h2/>").text(val.label);
    	var pcountent = $("<p/>").text(val.ldesc);
    	var pbutton = $("<p/>");
    	var a = $("<a/>",
			{
    			role: "button"
			}).addClass("btn btn-default");
    	if(val.sdesc == "USER_TYPE-PROSPECT")
    		a.attr("href", "register_login_prospect.php").html("Begin Your Journey");
    	else if(val.sdesc == "USER_TYPE-STUDENT")
    		a.attr("href", "register_login_student.php").html("Lets Get You In");
    	else if(val.sdesc == "USER_TYPE-ALUMNI")
    		a.attr("href", "register_login_alumni.php").html("Share What You Know");
    	else if(val.sdesc == "USER_TYPE-FACULTY")
    		a.attr("href", "register_login_faculty.php").html("Become the Guide");

		pbutton.append(a);
    	
    	div_col.append(img);
    	div_col.append(h2);
    	div_col.append(pcountent);
    	div_col.append(pbutton);
    	div_row.append(div_col);
    	
    	if(counter == numPerRow)
		{
    		$("#usertypes").append(div_row);
    		counter = 0;
		}
    	else
		{
    		counter++;
		}
    });
}

function gdCarouselFeaturette(data)
{
	/*
<hr class="featurette-divider">

<div class="row featurette">
<div class="col-md-7">
<h2 class="featurette-heading">First featurette heading. <span class="text-muted">It'll blow your mind.</span></h2>
<p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
</div>
<div class="col-md-5">
<img class="featurette-image img-responsive center-block" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
</div>
</div>
	 */
    $.each(data, function(key, val)
    {
    	var hr = $("<hr/>").addClass("featurette-divider");
    	var row = $("<div/>").addClass("row featurette");
    	var col1 = $("<div/>").addClass("col-md-7");
    	var h2 = $("<h2/>").addClass("featurette-heading").html(val.label);
    	var p = $("<p/>").addClass("lead").html(val.ldesc);

    	var col2 = $("<div/>").addClass("col-md-5");
    	var img = $("<img/>").addClass("featurette-image img-responsive center-block")
    		.attr("data-src", "holder.js/500x500/auto")
    		.attr("alt", "Generic placeholder image");

    	if(isOdd(key))
		{
    		col1.addClass(" col-md-push-5");
    		col2.addClass(" col-md-pull-7");
		}
    	
    	col1.append(h2);
    	col1.append(p);
    	
    	col2.append(img);
    	
    	row.append(col1)
    	row.append(col2);
    	
		$("#featurettes").append(hr);
		$("#featurettes").append(row);

    });
    Holder.run();

}
