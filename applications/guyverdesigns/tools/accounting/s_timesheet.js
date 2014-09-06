function buildTimesheetList(jqobj, data)
{
	jqobj.empty();
	var first = true;
    var cb = getContentBlock("list");
    // cb.css("width","200px");
    $("#workarea_col_left_scrolling").append(cb);
    
    $.each(data.RESULT, function(key, val)
    {
    	if(first)
		{
    		first = false;
    	    cb.append(getContentBlockHeader("Time Sheets"));
    	    cb.append(getContentBlockMessage());
    	    cb.append(getContentBlockSubHeader("Project : " + val.accounting_project_sdesc));
		}
    	
    	var li = getContentElementLI("text", null, null);
		li.css("clear","both");
		
    	var weeknumber = $("<p/>").text("Week : " + val.accounting_timesheet_dates_week_number);
    	weeknumber.css("float","left");
    	weeknumber.css("padding-top","7px");
    	weeknumber.css("padding-left","0px");
    	weeknumber.css("padding-right","20px");
    	weeknumber.css("margin-bottom","10px");
    	
    	var dates = $("<p/>").text(val.accounting_timesheet_dates_d0_work_date + " - " 
    				+ val.accounting_timesheet_dates_d6_work_date);
    	dates.css("float","left");
    	dates.css("padding-top","7px");
    	dates.css("margin-bottom","10px");
    		
		var total = parseInt(val.accounting_timesheet_dates_d0_work_hours);
		total = total + parseInt(val.accounting_timesheet_dates_d1_work_hours);
		total = total + parseInt(val.accounting_timesheet_dates_d2_work_hours);
		total = total + parseInt(val.accounting_timesheet_dates_d3_work_hours);
		total = total + parseInt(val.accounting_timesheet_dates_d4_work_hours);
		total = total + parseInt(val.accounting_timesheet_dates_d5_work_hours);
		total = total + parseInt(val.accounting_timesheet_dates_d6_work_hours);
		
    	var total = $("<p/>").text("Total : " + total);
    	total.css("float","left");
    	total.css("padding-top","7px");
    	total.css("padding-left","20px");
    	total.css("padding-right","20px");
    	total.css("margin-bottom","10px");
    		
    	var button1 = null;
    	if(val.accounting_timesheet_dates_cfg_workweekstatus_sdesc == "ACCOUNTING_WORKWEEKSTATUS_INVOICED")
    		button1 = getFormMiniButton("", "Invoiced", false);
    	else if(val.accounting_timesheet_dates_cfg_workweekstatus_sdesc == "ACCOUNTING_WORKWEEKSTATUS_DEACTIVATED")
    		button1 = getFormMiniButton("", "Deactivated", false);
    	else
    		button1 = getFormMiniButton("designDynamicContent('workarea_col_right', 'TIMESHEET_UDPATE_SCREEN_DATA', 'buildTimesheetEntry', 'accounting_timesheet_dates_uid=" + val.accounting_timesheet_dates_uid + "');", "Edit", false);
    	button1.css("float","right");
    	
    	li.append(weeknumber);
    	li.append(dates);
    	li.append(total);
    	li.append(button1);
    	
    	cb.append(li);
   });
}

function buildTimesheetEntry(jqobj, data, key, val)
{
	// Clear Dynamic Update Attributes
	var wcr = $("#workarea_col_right")
	.removeAttr("dyncontentkey")
	.removeAttr("funcname")
	.removeAttr("dyncontentqs");

	val = data.RESULT;
	jqobj.empty();
	
	var first = true;
    var cb = getContentBlock("update");
    // cb.css("width","200px");
    $("#workarea_col_right").append(getForm("update").append(cb));
    
	cb.append(getContentBlockHeader("Time Sheets"));
    cb.append(getContentBlockMessage());
    cb.append(getContentBlockSubHeader("Date : " + val.accounting_timesheet_dates_d0_work_date + " - " 
			+ val.accounting_timesheet_dates_d6_work_date));
	
    for(var idx = 0; idx <= 6; idx++)
	{
		var day = $("<li/>").text(eval("val.accounting_timesheet_dates_d" + idx + "_work_day"));
    
	    var hours = getFormInputTextField("update", "d" + idx + "_work_hours", eval("val.accounting_timesheet_dates_d" + idx + "_work_hours"), eval("val.accounting_timesheet_dates_d" + idx + "_work_date"), null)
	    var input = jQuery(hours).find("input");
	    input.keyup(function()
		{ 
	    	showTotal();
    	});

	    var ratetype = getFormSelectConfiguration("update", "d" + idx + "_cfg_ratetype_sdesc", "ACCOUNTING_RATETYPE" + "|" + eval("val.accounting_timesheet_dates_d" + idx + "_cfg_ratetype_sdesc"), "", "Choose Rate Type");
	    var select = jQuery(ratetype).find("select");
	    
	    day.css("clear","both");
	    day.css("font-size","14px");
	    hours.css("float","left");
	    input.css("width","30px");
	    ratetype.css("float","left");

    	cb.append(day).append(select).append(input);	
	}

    var total = getContentBlockText("updatetotal_hours", "Total : ", "0");
    total.css("padding-top","10px");
    cb.append(total);
    
    cb.append(getFormInputHiddenField("update", "uid", val.accounting_timesheet_dates_uid));
    cb.append(getFormGDControlkey("UPDATE_TIMESHEET_DATA"));
    cb.append(getFormButton("gdFuncUpdateData();", "Update"));
    
    loadDynamicPageElements();
}

function showTotal()
{
	var total = Number($("#updated0_work_hours").val()) + Number($("#updated1_work_hours").val())
	total = total + Number($("#updated2_work_hours").val()) + Number($("#updated3_work_hours").val());
	total = total +  Number($("#updated4_work_hours").val()) + Number($("#updated5_work_hours").val());
	total = total + Number($("#updated6_work_hours").val());
	$("#updatetotal_hours").text(total);
}

function gdFuncUpdateData()
{
    buildContentBlockReturnMessage();
    $.post("/_controls/ajax/ACCOUNTING.php", gdSerialize("update"), function(data)
    {
        data = eval("(" + data + ")");
        if(buildContentBlockReturnMessage(data, "RECORD_IS_UPDATED"))
        {
        	buildDynamicContent($("#workarea_col_left_scrolling"));
        	buildDynamicContent($("#workarea_col_right"));
        }
        else
        {
            buildContentBlockReturnMessage(data, true);
        }
    });
}