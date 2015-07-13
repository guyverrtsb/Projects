$(document).ready(function()
{
    $.post("/_controls/SERVICE.php",
	{
		SERVICE_CONTROL_KEY : "SEEMEU-GET_GROUPS_BY_ROLE",
		rolekey : "GROUP_ROLE-OWNER"
	},
	function(data)
    {
    	data = eval("(" + data + ")");
    	gdBuildGroupList(data.RETRIEVEGROUP, "list_groups_you_own", "Groups you own");
    });
    $.post("/_controls/SERVICE.php",
	{
		SERVICE_CONTROL_KEY : "SEEMEU-GET_GROUPS_BY_ROLE",
		rolekey : "GROUP_ROLE-USER"
	},
	function(data)
    {
    	data = eval("(" + data + ")");
    	gdBuildGroupList(data.RETRIEVEGROUP, "list_groups_you_use", "Groups you belong to");
    });
});

function gdBuildGroupList(data, elementId, dropdownlabel)
{
	/*
    <li><a href="/s_groups/wall.php">Wall</a></li>
	 */
	
    $.each(data, function(key, val)
    {
    	var li = $("<li/>");
    	var aMenuitem = $("<a/>")
			.attr("href", "#").html(val.groupaccount_ldesc);
    	li.append(aMenuitem);
    	$("#" + elementId).append(li);
    });
}