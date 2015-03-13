function zControlBattleMapFollowOtherGamer()
{
    $.post("/_controls/ajax/create/GAMERS.php", function(json)
    {
        json = eval("(" + json + ")");
        json = json.OPTIONS;
        $.each(json, function(key, val)
        {
            $.each(val, function(key, val)
            {
            	if(key == "HAZARD" || key == "SANCTUARY")
            	{
            		var objectType = key;
	                $.each(val, function(key, val)
	                {
	                	var marker = null;
	            		marker = eval("zBattleFieldObject" + objectType + "(zObjectBattleMap, objectType, val)");
	            		zObjectBattleMapMarkers[zObjectBattleMapMarkers.length] = marker; 
                	});
            	}
            });
        });
    });
}