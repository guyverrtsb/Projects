$(document).ready(function()
{
	var postdata = { "GD_CONTROLLER_KEY" : "SHOW_HEADLINES" };
	$.post("/_controls/ajax/DOCUMENT.php", postdata, function(data) {
	    if(!isDataMatch(data, "LIST_NOT_FOUND") && !isDataMatch(data, "TRANSACTION_FAIL"))
		{
	    	gdHeadlineJson = eval("(" + data + ")");
	        gdShowHeadlines();
	        gdHeadlineInterval = setInterval("gdShowHeadlines()", 15000);
		}
	});
});

var gdHeadlinePos = 0;	var gdHeadlineInterval = null;	var gdHeadlineJson = null;
var bkg = new Array();
bkg[bkg.length] = "/mimes/images/backgrounds/scaled/02841_theroadtonowhere_1440x900.jpg";
bkg[bkg.length] = "/mimes/images/backgrounds/scaled/00444_robotm1_1440x900.jpg";
bkg[bkg.length] = "/mimes/images/backgrounds/scaled/01281_hivistadiner_1440x900.jpg";
bkg[bkg.length] = "/mimes/images/backgrounds/scaled/01732_cavernray_1440x900.jpg";
bkg[bkg.length] = "/mimes/images/backgrounds/scaled/02089_onepath_1440x900.jpg";
bkg[bkg.length] = "/mimes/images/backgrounds/scaled/02341_theroadtobonneville_1440x900.jpg";
bkg[bkg.length] = "/mimes/images/backgrounds/scaled/00424_helsinkitrain_1440x900.jpg";
bkg[bkg.length] = "/mimes/images/backgrounds/scaled/01321_highwayatnighttheend_1440x900.jpg";
bkg[bkg.length] = "/mimes/images/backgrounds/scaled/01223_alittlemotivation_1440x900.jpg";
bkg[bkg.length] = "/mimes/images/backgrounds/scaled/02770_endless_1440x900.jpg";
bkg[bkg.length] = "/mimes/images/backgrounds/scaled/00681_ferriswheel_1440x900.jpg";
bkg[bkg.length] = "/mimes/images/backgrounds/scaled/01339_monumentvalley_1440x900.jpg";

function gdShowHeadlines()
{
    var json = gdHeadlineJson;
    if(json.length == gdHeadlinePos)
        gdHeadlinePos = 0;

    var d = new Array();
    d["title"] = json[gdHeadlinePos].title;
    d["template"] = json[gdHeadlinePos].document_template;
    d["uid"] = json[gdHeadlinePos].uid;
    d["object_uid"] = json[gdHeadlinePos].object_uid;
    d["bkg"] = getHeadlineBackgroundUrl(gdHeadlinePos);
    d["h0"] = json[gdHeadlinePos].headline0;
    d["h1"] = json[gdHeadlinePos].headline1;
    d["h2"] = json[gdHeadlinePos].headline2;
    d["h3"] = json[gdHeadlinePos].headline3;
    d["h4"] = json[gdHeadlinePos].headline4;
    
    zgdSetBackStrech(d["bkg"]);
    
    $("#gdHeadlines").html("");
    var ul = $("<ul/>").appendTo("#gdHeadlines");
    var la = $("<a/>",{
        class:"buttonOrange",
        title:"Launch Article",
        href:d["template"] + "?aid=" + d["object_uid"]
    }).text("Launch");
    
    $("<li/>",{class:"headline"}).html(d["title"]).appendTo(ul);
    
    $("<li/>",{class:"documentpoint" }).html(d["h0"]).appendTo(ul);
    $("<li/>",{class:"documentpoint" }).html(d["h1"]).appendTo(ul);
    $("<li/>",{class:"documentpoint" }).html(d["h2"]).appendTo(ul);
    $("<li/>",{class:"documentpoint" }).html(d["h3"]).appendTo(ul);
    $("<li/>",{class:"documentpoint" }).html(d["h4"]).appendTo(ul);
    
    la.appendTo($("<li/>",{class:"launch"}).appendTo(ul));

    gdHeadlinePos++;
}

function getHeadlineBackgroundUrl(pos)
{
	return bkg[pos];
}