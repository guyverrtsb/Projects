$(document).ready(function()
{
    zcBuildNavi("JSON");
	//zcBuildNavi("PNAVI");
});

function zcBuildNavi(type)
{
	if(type == "JSON")
	{
	    $.post("/json/menuitems.php", function(json)
	    {
	    	zcBuildMenuJSON(eval("(" + json + ")"));
	    });
	}
	else if(type = "PNAVI")
	{
		zcBuildMenuPNAVI();
	}
}


var mmcAry = new Array();
var numberOfMenuItems = 0;
var doDestroyMegaMenu = false;
function zcBuildMenuPNAVI()
{
	var json = "{\"LEVEL1\" : [";
	var jsonLvl1 = "";
	var lvl1IsFirst = true;
	
	var pnaviObj = $("#zcportalnavigation");
	pnaviObj.children("div").each(function ()
	{
		var lvl1Obj = $(this);
		if(lvl1Obj.attr("portalnavlevel") == 1)
		{
			var fobj = lvl1Obj.children().first();
			if(fobj.prop("tagName") == "A")
			{
				if(!lvl1IsFirst)
					jsonLvl1 += ",";
				jsonLvl1 += "{\"text\":\"" + fobj.text() + "\", \"href\":\"" + fobj.attr("href") + "\"}";
			}
			else if(fobj.prop("tagName") == "DIV")
			{
				
			}
			lvl1IsFirst = false;
		}
	});

	json += jsonLvl1 + "]}";
	alert(json);
	pnaviObj.remove();
	zcBuildMenuJSON(eval("(" + json + ")"));
}
function zcBuildMenuJSON(json)
{
	alert(json);
    alert(json.LEVEL1);
	var zcpaddingLR = "2";
	var idx = 0;
    var carousel = $("<div/>", {
    		id: "zcnavicarousel"
		});
    $.each(json.LEVEL1, function(key, val)
    {
        var text = json.LEVEL1[key].text;
        var href = json.LEVEL1[key].href;
        
        var lvl1 = $("<div/>", {
        	id: "zcnavilvl1_block_" + idx,
        	class: "zcnavilvl1_block"
        });
        
        if(json.LEVEL1[key].LEVEL2 != null)
        	mmcAry[lvl1.attr("id")] = json.LEVEL1[key].LEVEL2;
        
        var anchor = $("<a/>", {
            href: href,
            class: "btn btn-default btn-sm zcnavilvl1_link"
        }).text(text);
        
        anchor.mouseover(function()
		{
        	if(($(this).parent().attr("id") in mmcAry))
    		{
    			doDestroyMegaMenu = false;
            	var jqObj = zcBuildLevel2Content($(this).parent().attr("id"));
            	zcShowMegaMenu(jqObj);
    		}
        });
        
        anchor.mouseout(function()
		{
			doDestroyMegaMenu = true;
        	setTimeout(function()
			{
        		zcDestroyMegaMenu();
    		}, 1000);
		});
        
        lvl1.append(anchor);
        
        carousel.append(lvl1);
        idx++;
            
        $("#zcnavicontainer").append(carousel);
        numberOfMenuItems = idx;
    });
}

function zcBuildLevel2Content(level1Id)
{
	var zcmmc = $("<div/>")
	.attr("id", "zcmegamenu")
	.addClass("container-fluid img-rounded zcnavilvl2_block");
	zcmmc.mouseover(function()
	{
		doDestroyMegaMenu = false;
	})
	.mouseout(function()
	{
		doDestroyMegaMenu = true;
		setTimeout(function()
		{
			zcDestroyMegaMenu();
		}, 1000);
	})
	.children().each(function()
	{
		$(this).bind("mouseover", function()
		{
			doDestroyMegaMenu = false;
		});
	});
    
    $.each(mmcAry[level1Id], function(key2, val2)
    {
        var text2 = val2.text;
        var href2 = val2.href;

        var div = $("<div/>", {
    		class: "zcnavilvl2_block"
    	});
        var ul = $("<ul/>");
    	var li = $("<li/>");
        var anchor = $("<a/>", {
            href: href2
        })
        .text(text2)
        .addClass("btn btn-default btn-link zcnavilvl2link");

    	ul.append(li.append(anchor));
    	
        $.each(val2.LEVEL3, function(key3, val3)
	    {
	        var text3 = val3.text;
	        var href3 = val3.href;

	    	var li = $("<li/>");
	        var anchor = $("<a/>", {
	            href: href3
	        })
	        .text(text3)
	        .addClass("btn btn-default btn-link btn-xs zcnavilvl3link");
	        
	    	ul.append(li.append(anchor));
	    });
    	zcmmc.append(div.append(ul));
    });
	return zcmmc;
}

var currentFirstIdx = 0;
function zcRatchet(direction)
{
	var ml = $("#zcnavicarousel").css("margin-left");
	ml = ml.substring(0, ml.indexOf("p"));
	var w = 0;
	
	var newml = 0;
	if(direction == "L" && currentFirstIdx < (numberOfMenuItems - 1))
	{
		w = $("#zcnavilvl1_block_" + currentFirstIdx).css("width");
		w = w.substring(0, w.indexOf("p"));
		newml = ml - w;
		$("#zcnavicarousel").css("margin-left", newml);
		currentFirstIdx++;
	}
	else if(direction == "R" && currentFirstIdx > 0)
	{
		w = $("#zcnavilvl1_block_" + (currentFirstIdx - 1)).css("width");
		w = w.substring(0, w.indexOf("p"));
		newml = +ml + +w;
		$("#zcnavicarousel").css("margin-left", newml);
		currentFirstIdx--;
	}
}

function zcShowMegaMenu(jqObj)
{
	if ($("#zcmegamenu").length)
	{
		$("#zcmegamenu").remove();
    }
	$("#header").after(jqObj);
}

function zcSetDoDestroyMegaMenuControl(doDestroyMegaMenuTF)
{
	doDestroyMegaMenu = doDestroyMegaMenuTF;
}

function zcDestroyMegaMenu()
{
	if(doDestroyMegaMenu)
	{
		$("#zcmegamenu").remove();
	}
}