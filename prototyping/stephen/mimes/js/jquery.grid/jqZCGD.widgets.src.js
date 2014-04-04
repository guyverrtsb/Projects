// ==ClosureCompiler==
// @compilation_level SIMPLE_OPTIMIZATIONS

/**
 * @license jqGrid  4.6.0 - jQuery Grid
 * Copyright (c) 2008, Tony Tomov, tony@trirand.com
 * Dual licensed under the MIT and GPL licenses
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl-2.0.html
 * Date: 2014-02-20
 */
//jsHint options
/*jshint evil:true, eqeqeq:false, eqnull:true, devel:true */
/*global jQuery */
(function ($)
{
	$.jgrid.extend(
	{
		version : "0.0.3",
		zcgdOutputMessages : function (msg)
		{
			alert($(this).attr("id"));
		},
		zcgdWidgetBuildProductSelector : function (data)
		{
			var cbobj = $(this);
			var filterobj = cbobj.jqGrid("zcgdUtilFindChildObj", {type:"index", match:"0"});
			var prodobj = cbobj.jqGrid("zcgdUtilFindChildObj", {type:"index", match:"1"});
			var pageobj = cbobj.jqGrid("zcgdUtilFindChildObj", {type:"index", match:"2"});
			var actionobj = cbobj.jqGrid("zcgdUtilFindChildObj", {type:"index", match:"3"});
			
	        var dataProductList = data;
	        
	        // Build jqGRid with Product List Data
	        prodobj.jqGrid({
	            datatype: "local",
	            colNames:['Product','Product Description', 'Practice Area', 'Jurisdication','Format','Approval Req.'],
	            colModel:[
	                {name:'matnr', index:'matnr', width:60, align:"left", sorttype:"int", search:true, stype:"text"},
	                {name:'proddesc', index:'proddesc', width:90, align:"left", sorttype:"text", search:true, stype:"text"},
	                {name:'pracarea', index:'pracarea', width:100, align:"left", sorttype:"text", search:true, stype:"text"},
	                {name:'juris', index:'juris', width:80, align:"left", sorttype:"text", search:true, stype:"text"},
	                {name:'format', index:'format', width:80, align:"left", sorttype:"text", search:true, stype:"text"},     
	                {name:'appreq', index:'appreq', width:80, align:"left", sorttype:"text", search:true, stype:"text"}     
	            ],
	            rowNum:10,
	            rowList:[10,20,30],
	            pager: "#" + pageobj.attr("id"),
	            sortname: "matnr",
	            viewrecords: true,
	            sortorder: "desc",
	            multiselect: true,
	            caption:"Product Selection"
	        });
	        
	        for(var idx = 0; idx <= dataProductList.length; idx++)
	        {
	        	prodobj.jqGrid('addRowData', (idx + 1), dataProductList[idx]);
	        }
	        
        	cbobj.jqGrid("zcgdProductSelectFilter", filterobj, prodobj, dataProductList);
	        
	        var button = $("<input/>");
	        	button.attr("type", "button");
	        	button.attr("name", "zcgdproductlistaction");
	        	button.attr("value", "Select Products");
	        	button.attr("class", "buttonproductselection")
	        	button.click(function()
    			{
	    		    var ids = prodobj.jqGrid("getGridParam", "selarrrow");
	    		    var o = "";
	    		    for(var idx = 0; idx < ids.length; idx++)
	    		    {
	    		    	if(idx == 0)
	    		    		o += "<products>";
    		    		o += "<product>";
    		            o += "<matnr>" + prodobj.jqGrid ("getCell", ids[idx], "matnr") + "</matnr>";
    		            o += "<juris>" + prodobj.jqGrid ("getCell", ids[idx], "juris") + "</juris>";
    		    		o += "</product>";
	    		    		
    		            if(idx < (ids.length - 1))
    		            	o += "\n";
    		            else if(idx == (ids.length - 1))
    		            	o += "</products>";
	    		    }
	    		    if(o == "")
	    		    	alert("nothing has been selected.");
	    		    else
	    		    	alert(o);
    			});
	        	
        	actionobj.append(button);
	        
	        prodobj.setGridWidth(cbobj.width(), true);
		},
		zcgdWidgetBuildSubscriptionSelector : function (dataSoldtoList, dataProductList)
		{
			var cbobj = $(this);
        	var soldtoobj = cbobj.jqGrid("zcgdUtilFindChildObj", {type:"index", match:"0"});
			var prodobj = cbobj.jqGrid("zcgdUtilFindChildObj", {type:"index", match:"2"});
			var actionobj = cbobj.jqGrid("zcgdUtilFindChildObj", {type:"index", match:"3"});
			
		    /** Sold To List **/
			soldtoobj.jqGrid({
		        datatype: "local",
		        colNames:['Sold To No.','Name', 'Address', 'City','Region'],
		        colModel:[
		            {name:'soldtonum', index:'soldtonum', width:80, align:"left", sorttype:"int"},
		            {name:'name', index:'name', width:90, align:"left", sorttype:"text"},
		            {name:'address', index:'address', width:15, align:"left", sorttype:"text"},
		            {name:'city', index:'city', width:100, align:"left", sorttype:"text"},
		            {name:'region', index:'region', width:50, align:"left", sorttype:"text"}    
		        ],
		       //rowNum:10,
		        // rowList:[10,20,30],
		        // pager: '#sapSscProductPager',
		        sortname: "soldtonum",
		        viewrecords: true,
		        sortorder: "desc",
		        multiselect: true,
		        caption:"Existing Subscription Selector",
		        onSelectRow: function (id, status) 
		        {
		        	cbobj.jqGrid("zcgdFilterProductsbySoldto", soldtoobj, "soldtonum", prodobj);
		        },
		        onSelectAll : function (aRowIds, status)
		        {
		        	cbobj.jqGrid("zcgdFilterProductsbySoldto", soldtoobj, "soldtonum", prodobj);
		        }
		    });
		    
		    /** Sold To Product List **/
			prodobj.jqGrid({
		        datatype: "local",
		        colNames:['Product','Product Description','Qty','Bundle ID','Bundle Type','Sold to Party','Ship to Name','Approval Req.'],
		        colModel:[
		            {name:'matnr', index:'matnr', width:80, align:"left", sorttype:"int"},
		            {name:'proddesc', index:'proddesc', width:150, align:"left", sorttype:"datextte"},
		            {name:'qty', index:'qty', width:20, align:"left", sorttype:"text"},
		            {name:'bundleid', index:'bundleid', width:80, align:"left", sorttype:"text"},
		            {name:'bundletype', index:'bundletype', width:80, align:"left", sorttype:"text"}  ,
		            {name:'soldtonum', index:'soldtonum', width:80, align:"left", sorttype:"int"}  ,
		            {name:'shiptoname', index:'shiptoname', width:100, align:"left", sorttype:"text"}  ,
		            {name:'appreq', index:'appreq', width:80, align:"left", sorttype:"text"}     
		        ],
		        //rowNum:5,
		        // rowList:[10,20,30],
		        // pager: '#sapSscProductPager',
		        sortname: "matnr",
		        viewrecords: true,
		        sortorder: "desc",
		        multiselect: true,
		        caption:"Select Existing Subscriptions"
		    });
			
	        for(var i=0;i<=dataSoldtoList.length;i++)
	        {
	        	soldtoobj.jqGrid('addRowData',i+1,dataSoldtoList[i]);
	        }
	        for(var i=0;i<=dataProductList.length;i++)
	        {
	        	prodobj.jqGrid('addRowData',i+1,dataProductList[i]);
	        }
	        
	        var button = $("<input/>");
	        	button.attr("type", "button");
	        	button.attr("name", "zcgdsoldtoproductlistaction");
	        	button.attr("value", "Select Products");
	        	button.attr("class", "buttonproductselection")
	        	button.click(function()
    			{
	    		    var ids = prodobj.jqGrid("getGridParam", "selarrrow");
	    		    var o = "";
	    		    for(var idx = 0; idx < ids.length; idx++)
	    		    {
	    		    	if(idx == 0)
	    		    		o += "<products>";
    		    		o += "<product>";
    		            o += "<matnr>" + prodobj.jqGrid ("getCell", ids[idx], "matnr") + "</matnr>";
    		            o += "<soldtonum>" + prodobj.jqGrid ("getCell", ids[idx], "soldtonum") + "</soldtonum>";
    		            o += "<bundleid>" + prodobj.jqGrid ("getCell", ids[idx], "bundleid") + "</bundleid>";
    		            o += "<bundletype>" + prodobj.jqGrid ("getCell", ids[idx], "bundletype") + "</bundletype>";
    		            o += "<shiptoname>" + prodobj.jqGrid ("getCell", ids[idx], "shiptoname") + "</shiptoname>";
    		    		o += "</product>";
	    		    		
    		            if(idx < (ids.length - 1))
    		            	o += "\n";
    		            else if(idx == (ids.length - 1))
    		            	o += "</products>";
	    		    }
	    		    if(o == "")
	    		    	alert("nothing has been selected.");
	    		    else
	    		    	alert(o);
    			});
	        	
        	actionobj.append(button);
	        
	        prodobj.setGridWidth(cbobj.width(), true);
		},
		zcgdFilterProductsbySoldto : function (soldtoobj, field, prodobj)
		{
		    // alert(gridSoldTo + " - " + field + " - " + gridProducts);
		    var ids = soldtoobj.jqGrid("getGridParam", "selarrrow");
		    var filter = new Array();
		    for(var idx = 0; idx < ids.length; idx++)
		    {
		        var filterCondition = new Object();
		            filterCondition.field = field;
		            filterCondition.op = "eq";
		            filterCondition.data = soldtoobj.jqGrid ("getCell", ids[idx], field);
		            filter[filter.length] = filterCondition;
		    }
		    soldtoobj.jqGrid("zcgdFilterGrid", prodobj, filter, "OR");
		},
		zcgdFilterGrid : function (prodobj, filter, groupop)
		{
		    var post = prodobj.jqGrid("getGridParam", "postData");
		    if(filter.length > 0)
		    {
		        var filterArray = new Array();
		        for(var idx = 0; idx < filter.length; idx++)
		        {
		        	var f = filter[idx];
		        	//alert("|" + f.field + "|\n|" + f.op + "|\n|" + f.data + "|");
		            filterArray.push(filter[idx]);
		        }

		        $.extend(post, {filters:{"groupOp" : groupop,
		                        "rules" : filterArray}
		        });
		                        
		        prodobj.jqGrid("setGridParam", {
		            search: true,
		            postData: post
		        });
		    }
		    else
		    {
		        $.extend(post, {filters:{"groupOp" : "OR",
		                        "rules" : []}});
		    }
		    prodobj.trigger("reloadGrid", [{page:1}]);
		},
		zcgdProductSelectFilter : function (filterobj, prodobj, dataProductList)
		{
	        var cl = dataProductList[0]; // Columns Names
	        
			var defaultVals = new Array();
			var focusedObjectId;
			if(filterobj.children().length == 0 )
			{
		        var cidx = 0;
		        for (var key in cl)
		        {
		        	var colname = key;
		            var colvalu = cl[colname];
		        	defaultVals[cidx] = "";
		        	if(cidx == 0)
		        	{
		        		focusedObjectId = "sapsscformfield" + colname;
		        	}
		        	cidx++;
		        }
			}
			else
			{
		        var cidx = 0;
		        for (var key in cl)
		        {
		        	var colname = key;
		            var colvalu = cl[colname];
		            var obj = $("#sapsscformfield" + colname);
		        	defaultVals[cidx] = obj.val();
		        	if(obj.is(":focus"))
		        	{
		        		// alert("sapsscformfield" + colname + ":is focus");
		        		focusedObjectId = "sapsscformfield" + colname;
		        	}
		        	cidx++;
		        }
		        //alert("Delta:" + defaultVals);
			}
				
			filterobj.empty();
	        // Build filters
	        var cidx = 0;
	        for (var key in cl)
	        {
	            var colname = key;
	            var colvalu = cl[colname];
	            // alert(colname + " : " + colvalu);
	            
	            var li = $("<li/>");
	            var label = $("<label/>");
	                label.attr("class", "sapsscformfieldlabel");
	                label.text(prodobj.jqGrid("getGridParam", "colNames")[(cidx + 1)]);
	            var ele = null;
	            if(colname == "matnr" || colname == "proddesc")
	            {
	                ele = $("<input/>");
	                ele.attr("type", "text");
	                ele.attr("id", "sapsscformfield" + key);
	                ele.attr("name", "sapsscformfield" + key);
	                ele.attr("class", "sapsscformfieldInput");
	                ele.attr("jqgridcolname", colname);
	                ele.val(defaultVals[cidx]);
	                ele.keyup(function()
            		{
	                    var filter = new Array();
	                    filterobj.children().each(function(idx, obj)
	                    {
	                        var eleobj = $(obj).children("input");
	                        if(eleobj.prop("tagName"))
	                        {
	                            if(eleobj.val() != "")
	                            {
	                                var filterCondition = new Object();
	                                    filterCondition.field = eleobj.attr("jqgridcolname");
	                                    filterCondition.op = "cn";
	                                    filterCondition.data = eleobj.val();
	                                filter[filter.length] = filterCondition;
	                            }
	                        }
	                            
	                        var eleobj = $(obj).children("select");
	                        if(eleobj.prop("tagName"))
	                        {
	                            if(eleobj.val() != "")
	                            {
	                                var filterCondition = new Object();
	                                    filterCondition.field = eleobj.attr("jqgridcolname");
	                                    filterCondition.op = "eq";
	                                    filterCondition.data = eleobj.val();
	                                filter[filter.length] = filterCondition;
	                            }
	                        }
	                    });
	                    filterobj.jqGrid("zcgdFilterGrid", prodobj, filter, "AND");
	                    filterobj.jqGrid("zcgdProductSelectFilter", filterobj, prodobj, dataProductList);
	                });
	            }
	            else
	            {
	                ele = $("<select/>");
	                ele.attr("type", "text");
	                ele.attr("id", "sapsscformfield" + key);
	                ele.attr("name", "sapsscformfield" + key);
	                ele.attr("class", "sapsscformfieldSelect");
	                ele.attr("jqgridcolname", colname);
	                ele.change(function()
            		{
	                    var filter = new Array();
	                    filterobj.children().each(function(idx, obj)
	                    {
	                        var eleobj = $(obj).children("input");
	                        if(eleobj.prop("tagName"))
	                        {
	                            if(eleobj.val() != "")
	                            {
	                                var filterCondition = new Object();
	                                    filterCondition.field = eleobj.attr("jqgridcolname");
	                                    filterCondition.op = "cn";
	                                    filterCondition.data = String(eleobj.val());
	                                filter[filter.length] = filterCondition;
	                            }
	                        }
	                            
	                        var eleobj = $(obj).children("select");
	                        if(eleobj.prop("tagName"))
	                        {
	                            if(eleobj.val() != "")
	                            {
	                                var filterCondition = new Object();
	                                    filterCondition.field = eleobj.attr("jqgridcolname");
	                                    filterCondition.op = "eq";
	                                    filterCondition.data = String(eleobj.val());
	                                filter[filter.length] = filterCondition;
	                            }
	                        }
	                    });
	                    filterobj.jqGrid("zcgdFilterGrid", prodobj, filter, "AND");
	                    filterobj.jqGrid("zcgdProductSelectFilter", filterobj, prodobj, dataProductList);
                    });
	            }
	            li.append(label);
	            li.append(ele)
	            filterobj.append(li);
	            
	            if(ele.prop("tagName") == "SELECT")
	            {
	            	
	        		var rids = prodobj.getDataIDs();	// 1-10
	        		//alert(numrows); // 1-10
	            	var option = $("<option/>");
	                    option.val("");
	                    option.text("Choose");
                    ele.append(option);
	            	var container = new Array();
	        		for(var idx = 0; idx < rids.length; idx++)
	                {
	                    var val = prodobj.jqGrid("getCell", rids[idx], ele.attr("jqgridcolname"));
	                    
	                    // if(ele.attr("jqgridcolname") == "juris")
	                    //	alert("jqgridcolname:" + ele.attr("jqgridcolname") + "\nval:" + val + "\n" + prodobj.getDataIDs());

	                    if($.inArray(val, container) == -1)
	                    {
	                    	// alert(val);
		                    var option = $("<option/>");
		                        option.val(val);
		                        option.text(val);
		                    ele.append(option);
		                    container[container.length] = val;
	                    }
	  
	                }
	                container = new Array();
	            }
	            else if(ele.prop("tagName") == "SELECTtmp")
            	{
	        		for(var idx = 0; idx < numrows; idx++)
        			{
		        		var myCellData = prodobj.jqGrid("getCell", idx, ele.attr("jqgridcolname"));
		        		alert(myCellData);
        			}
            	}
	            cidx++;
	        }
	        
	        // Set Focus
        	var focusele = $("#" + focusedObjectId);
            if(focusele.prop("tagName") == "INPUT")
        	{
            	focusele.focus();
            	var val = focusele.val();
            	focusele.val(val);
            	focusele[0].setSelectionRange(focusele.val().length, focusele.val().length);
        	}
            else
            {
    	        $("#" + focusedObjectId).focus();
            }

		},
		zcgdUtilFindChildObj : function (control)
		{
			if(control.type.toUpperCase() == "INDEX" )
			{
				var toReturn;
				$(this).children().each(function(idx, obj)
				{
					if(idx == control.match)
					{
						toReturn = ($("#" + obj.id));
						return false;
					}
				});
				return toReturn;
			}
		}
	});
})(jQuery);