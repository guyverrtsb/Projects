$(document).ready(function()
{
	load(0, 32);
	var startIdx = 32;
	var rowCount = 32;
	$(window).scroll(function()
	{
		if($(window).scrollTop() + $(window).height() > Math.ceil($(document).height() * 0.75))
		{
			if(!endOfList && allowScrollLoad)
			{
				allowScrollLoad = false;
				load(startIdx, rowCount);
				startIdx = startIdx + rowCount;
			}
		}
	});
});

var allowScrollLoad = true;
var endOfList = false;
function load(startIdx, rowCount)
{
    $.post("/_controls/SERVICE.php",
	{
		SERVICE_CONTROL_KEY : "SEEMEU-GET_LIST_OF_SCHOLARSHIP_SOURCE"
			, START_IDX : startIdx, ROW_COUNT : rowCount
	},
	function(data)
    {
		allowScrollLoad = true;
		data = eval("(" + data + ")");
		if(data.RETRIEVEENTITYSCHOLARSHIPSOURCE != null)
			gdBuildScholarships(data.RETRIEVEENTITYSCHOLARSHIPSOURCE, "list_entityscholarshipsource", 4);
		else
			endOfList = true;
    });
}

/*
 * Builds the column rows
 * numPerRow = (1, 2 ,3 ,4, 6, 12)
 * jsonObj = JSON Object
 */
function gdBuildScholarships(data, elementId, numPerRow)
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
	var counter = 1; 
	var cellspan = Math.floor(12 / numPerRow);
	var div_row = null;
    $.each(data, function(key, val)
    {
    	if(counter == 1)
    		div_row = $("<div/>").addClass("row");
    	
    	var div_col = $("<div/>").addClass("col-lg-" + cellspan);
    	var img = $("<img/>",
			{
				src: "data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==",
				alt: "Generic placeholder image",
				width: "140",
				height: "140"
			}).addClass("img-circle");
    	
    	var h2 = $("<h2/>");
    	var pcountent1 = $("<p/>");
    	var pcountent2 = $("<p/>");
    	var pcountent3 = $("<p/>");
    	var pbutton = $("<p/>");
    	var a = $("<a/>",
		{
			role: "button"
		}).addClass("btn btn-default");
    	
		var urlAry = val.url.split("/");

		h2.text("Scholarship [" + val.idx + "]");
		if(urlAry[(urlAry.length - 1)] != "")
			pcountent1.text(urlAry[(urlAry.length - 1)]);
		else
			pcountent1.text(urlAry[(urlAry.length - 2)]);
		pcountent2.text("");
		pcountent3.text("");
    	a.attr("href", val.url).text("launch");

		pbutton.append(a);
    	
    	div_col.append(img);
    	div_col.append(h2);
    	div_col.append(pcountent1);
    	div_col.append(pcountent2);
    	div_col.append(pcountent3);
    	div_col.append(pbutton);
    	div_row.append(div_col);
    	
    	if(counter == numPerRow)
		{
    		$("#" + elementId).append(div_row);
    		counter = 1;
    		div_row = null;
		}
    	else
		{
    		counter++;
		}
    });
    
    if(div_row != null)
		$("#" + elementId).append(div_row);
}