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
			var filterobj = cbobj.jqGrid("zcgdUtilFindChildObj", {type:"index", match:"1"});
			var prodobj = cbobj.jqGrid("zcgdUtilFindChildObj", {type:"index", match:"2"});
			var pageobj = cbobj.jqGrid("zcgdUtilFindChildObj", {type:"index", match:"3"});
			var actionobj = cbobj.jqGrid("zcgdUtilFindChildObj", {type:"index", match:"4"});
			
	        var dataProductList = data;
	        // Build filters
	        var rl = dataProductList.length; // Numnber of Records;
	        var cl = dataProductList[0]; // Columns Names
	        var cidx = 0;
	        for (var key in cl)
	        {
	            var colname = key;
	            var colvalu = cl[colname];
	            // alert(colname + " : " + colvalu);
	            
	            var li = $("<li/>");
	            var label = $("<label/>");
	                label.attr("class", "sapsscformfieldlabel");
	                label.text(colname);
	            var ele = null;
	            if(colname == "matnr" || colname == "proddesc")
	            {
	                ele = $("<input/>");
	                ele.attr("type", "text");
	                ele.attr("id", "sapsscformfield" + key);
	                ele.attr("name", "sapsscformfield" + key);
	                ele.attr("class", "sapsscformfieldInput");
	                ele.attr("jqgridcolname", colname);
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
                    });
	            }
	            li.append(label);
	            li.append(ele)
	            filterobj.append(li);
	            
	            if(ele.prop("tagName") == "SELECT")
	            {
	            	var option = $("<option/>");
	                    option.val("");
	                    option.text("Choose");
                    ele.append(option);
	            	var container = new Array();
	                for(var idx = 0; idx < rl; idx++)
	                {
	                    var val = dataProductList[idx][colname];
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
	            cidx++;
	        }
	        
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
	            //rowNum:10,
	            rowList:[10,20,30],
	            pager: "#" + pageobj.attr("id"),
	            sortname: 'id',
	            viewrecords: true,
	            sortorder: "desc",
	            multiselect: true,
	            caption:"Product Selection"
	        });
	        
	        for(var idx = 0; idx <= dataProductList.length; idx++)
	        {
	        	prodobj.jqGrid('addRowData', (idx + 1), dataProductList[idx]);
	        }
	        
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
        	var soldtoobj = cbobj.jqGrid("zcgdUtilFindChildObj", {type:"index", match:"1"});
			var prodobj = cbobj.jqGrid("zcgdUtilFindChildObj", {type:"index", match:"3"});
			var actionobj = cbobj.jqGrid("zcgdUtilFindChildObj", {type:"index", match:"4"});
			
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
		        sortname: 'id',
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
		        sortname: 'id',
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