var gdData_Index = null;
var gdDataGroups_Index = null;
var gdPosition_Index = 0;
var gdInterval_Index = null;
var gdJqObj_Index = null;
var gdNumofGroups = 0;
function buildUniversityElements(jqobj, data)
{
	if(data.RETURN_KEY == "SUCCESS")
	{
		gdJqObj_Index = jqobj;
		gdNumofGroups = data.GROUP_COUNTS;
		gdData_Index = new Array();
	    $.each(data.RESULT, function(key, val)
	    {
	    	gdData_Index[gdData_Index.length] = val;
	    });
	    gdShowUniversity();
	    gdInterval_Index = setInterval("gdShowUniversity()", 10000);
	}
}

var bkg = new Array();
bkg[bkg.length] = "/mimes/images/backgrounds/scaled/00444_robotm1_1440x900.jpg";
bkg[bkg.length] = "/mimes/images/backgrounds/scaled/01281_hivistadiner_1440x900.jpg";
bkg[bkg.length] = "/mimes/images/backgrounds/scaled/01732_cavernray_1440x900.jpg";
bkg[bkg.length] = "/mimes/images/backgrounds/scaled/02089_onepath_1440x900.jpg";
bkg[bkg.length] = "/mimes/images/backgrounds/scaled/02341_theroadtobonneville_1440x900.jpg";
bkg[bkg.length] = "/mimes/images/backgrounds/scaled/00424_helsinkitrain_1440x900.jpg";
bkg[bkg.length] = "/mimes/images/backgrounds/scaled/02841_theroadtonowhere_1440x900.jpg";
bkg[bkg.length] = "/mimes/images/backgrounds/scaled/01321_highwayatnighttheend_1440x900.jpg";
bkg[bkg.length] = "/mimes/images/backgrounds/scaled/01223_alittlemotivation_1440x900.jpg";
bkg[bkg.length] = "/mimes/images/backgrounds/scaled/02770_endless_1440x900.jpg";
bkg[bkg.length] = "/mimes/images/backgrounds/scaled/00681_ferriswheel_1440x900.jpg";
bkg[bkg.length] = "/mimes/images/backgrounds/scaled/01339_monumentvalley_1440x900.jpg";

function gdShowUniversity()
{
    if(gdData_Index.length == gdPosition_Index)
    	gdPosition_Index = 0;
    
    var json = gdData_Index[gdPosition_Index];
    
    gdJqObj_Index.html("");
    var ul = $("<ul/>").appendTo(gdJqObj_Index);
    
    $("<li/>").attr("class","menuheader").html(json.university_profile_name).appendTo(ul);
    
    $("<li/>").attr("class","menuitem").html(json.university_profile_name).appendTo(ul);
    $("<li/>").attr("class","menuitem").html(json.university_account_sdesc).appendTo(ul);
    $("<li/>").attr("class","menuitem").html(json.university_profile_foundeddate).appendTo(ul);
    $("<li/>").attr("class","menuitem").html(json.university_account_emailkey).appendTo(ul);
    $("<li/>").attr("class","menuitem").html(json.university_profile_content).appendTo(ul);
    $("<li/>").attr("class","menuitem").html("Number of Groups : " + eval("gdNumofGroups." + json.university_account_sdesc)).appendTo(ul);
   
    
    var la = $("<a/>",{
        title:"Launch Article",
        href:"siteaccess.php"
    }).attr("class","buttonOrange").text("LogIn");
    la.appendTo($("<li/>").attr("class","launch").appendTo(ul));
    
    zgdSetBackStrech(bkg[gdPosition_Index]);
    
    gdPosition_Index++;
}
