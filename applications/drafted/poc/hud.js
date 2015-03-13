var zObjectBattleMap = null;    // Global Object for the Battle Map
var zObjectBattleMapGamer = null;   // Global Object for Gamer Icon on Map
var zControlBattleMapInterval = null;   // GLobal Object for the Interval Control to RE-CEnter Map on Gamer
var zObjectBattleMapLatLng = new Array();   // Global Object that Tracks the Center Position for the Gamer.
var zObjectBattleMapMarkers = Array();	// Markers for the Battle Map.  These Represent Hazards, Sanctuaries, Tools

$(document).ready(function()
{
	zControlBattleMapUI("map-canvas");
    if (navigator.geolocation) 
    {
    	//** Initialize Battle Map
        navigator.geolocation.getCurrentPosition(zControlBattleMapInitialze, 
        		zControlGamerMapStatus,
            { enableHighAccuracy: true, timeout: 60000, maximumAge: 0 }
        );
        
        //** Load Battle Map Data
        zControlBattleMapLoad();

	    //** Watch Position Lat Lng and Update Battle Map
        navigator.geolocation.watchPosition(
    		zControlBattleMapFollowGamer, 
    		zControlGamerMapStatus,
    		{
        		enableHighAccuracy: true
    			, timeout: 60000
    			, maximumAge: 2000
    		}
        );
        
        
    }
    else
    { 
        var date = new Date();
        document.getElementById("map-info-date").innerHTML = "DATE_TIME:{" + date.getTime() + "}:";
        document.getElementById("map-info-error").innerHTML = "ERROR:{Geo location is not allowed on this Browser}:";
    }
});

/**
 * Design Battle Map based on the type of Device
 * @param mapCanvasId
 */
function zControlBattleMapUI(mapCanvasId)
{
    var useragent = navigator.userAgent;
    var mapdiv = document.getElementById(mapCanvasId);
    
    if (useragent.indexOf('iPhone') != -1 || useragent.indexOf('Android') != -1 )
    {
        mapdiv.style.width = '100%';
        mapdiv.style.height = '90%';
    }
    else
    {
        mapdiv.style.width = '800px';
        mapdiv.style.height = '600px';
    }
}

/**
 * Create the Control for the Gamer Map.  This is the Initializer.
 * It is important to only call this mehtod once.  Afterwards use
 * the  zControlGamerMapCenter to ensure the map is centered around
 * Gamer.  Thus making the Gamer the center of the World
 */
function zControlBattleMapInitialze(position)
{
    zObjectBattleMapLatLng["gamrLat"] = position.coords.latitude;
    zObjectBattleMapLatLng["gamrLng"] = position.coords.longitude;
    
    var mapOptions = {
        center: { lat: zObjectBattleMapLatLng["gamrLat"], lng: zObjectBattleMapLatLng["gamrLng"]},
        zoom: 18,	/* 1(World Views) - 20(Tight View)*/
        mapTypeId: google.maps.MapTypeId.SATELLITE
    };
    
    zObjectBattleMap = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
    zObjectBattleMap.setTilt(45);
    
    zObjectBattleMapGamer = new google.maps.Marker(
    {
        position: new google.maps.LatLng(zObjectBattleMapLatLng["gamrLat"], zObjectBattleMapLatLng["gamrLng"]),
        map: zObjectBattleMap,
        title: 'Hello World!'
    });
    
    zObjectBattleMapLatLng["crntLat"] = zObjectBattleMapLatLng["gamrLat"];
    zObjectBattleMapLatLng["crntLng"] = zObjectBattleMapLatLng["gamrLng"];
}

/**
 * Loading Battle Map Data Hazards, Sanctuaries, Tools
 */
function zControlBattleMapLoad()
{
    $.post("/json/battlefieldobjects.php", function(json)
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

/**
 * Used in tandem with a Set Interval this method will ensure the
 * Battle Map is centered around the Gamer.  Or more accurately
 * the Gamer is Centered around the Battle Map 
 */
function zControlBattleMapFollowGamer(position)
{
    zObjectBattleMapLatLng["gamrLat"] = position.coords.latitude;
    zObjectBattleMapLatLng["gamrLng"] = position.coords.longitude;
    
    document.getElementById("map-info-crnt").innerHTML = "CRNT_LAT :{" + zObjectBattleMapLatLng["crntLat"] + "}:CRNT_LNG :{" + zObjectBattleMapLatLng["crntLng"] + "}:";
    document.getElementById("map-info-gamr").innerHTML = "GAMR_LAT:{" + zObjectBattleMapLatLng["gamrLat"] + "}:GAMR_LNG:{" + zObjectBattleMapLatLng["gamrLng"] + "}:";
    var date = new Date();
    document.getElementById("map-info-date").innerHTML = "DATE_TIME:{" + date.getTime() + "}:";
    
    if(zObjectBattleMapLatLng["crntLat"] != zObjectBattleMapLatLng["gamrLat"]
        || zObjectBattleMapLatLng["crntLng"] != zObjectBattleMapLatLng["gamrLng"])
    {
        zObjectBattleMapGamer.setMap(null);
        
        var zObjectBattleMapCenterLatLng = new google.maps.LatLng(zObjectBattleMapLatLng["gamrLat"], zObjectBattleMapLatLng["gamrLng"]);
        zObjectBattleMap.setCenter(zObjectBattleMapCenterLatLng);
        
        zObjectBattleMapGamer = new google.maps.Marker(
        {
            position: zObjectBattleMapCenterLatLng,
            map: zObjectBattleMap,
            title: 'Hello World!'
        });
        
        zObjectBattleMapLatLng["crntLat"] = zObjectBattleMapLatLng["gamrLat"];
        zObjectBattleMapLatLng["crntLng"] = zObjectBattleMapLatLng["gamrLng"];
    }
    
    zControlHazardDistancetoGamer();
    
    zControlGamerMapStatus({
	    code: 0, 
	    message: "Good Map Status",
    	timeofcoords: position.timestamp,
    	method: "zControlBattleMapFollowGamer"
	});
}

/**
 *Use this to display various error message with regards to the
 * Gamer Position and Battle Map 
 */
var watchcount = 0;
function zControlGamerMapStatus(status)
{
    var date = new Date();
    document.getElementById("map-info-date").innerHTML = "DATE_TIME:{" + date.getTime() + "}:";
    document.getElementById("map-info-status").innerHTML = "CODE:{" + status.code + "}:MESSAGE:{" + status.message + "}:TIME:{" + status.timeofcoords + "}";
    if(status.method != null && status.method == "zControlBattleMapFollowGamer")
	{
        document.getElementById("map-info-watchcount").innerHTML = "METHOD:{" + status.method + "}:COUNT:{" + watchcount + "}";
        watchcount = watchcount + 1;
	}
    	
}

function zControlHazardDistancetoGamer()
{
	for (var idx = 0; idx < zObjectBattleMapMarkers.length; idx++)
	{
		var zobmm = zObjectBattleMapMarkers[idx];
		$("#map-info-hazard-range_" + idx).remove();
		var li = $("<li/>").attr("id", "map-info-hazard-range_" + idx)
						.html(zobmm.zMarkerGamerInRangeData());
		if(zobmm.zMarkerIsGamerInRangeData())
		{
			if(zobmm.zMarkerType == "HAZARD")
				li.css("background-color", "#ff0000").css("color", "#ffffff");	// Show Red for Explosion
			else if(zobmm.zMarkerType == "SANCTUARY")
				li.css("background-color", "#0000ff").css("color", "#ffffff");	// Show Blue for Explosion
		}
		else
		{
			if(zobmm.zMarkerType == "HAZARD")
				li.css("background-color", "#00ff00").css("color", "#000000");	// Show Green for Safe
			else if(zobmm.zMarkerType == "SANCTUARY")
				li.css("background-color", "#cecece").css("color", "#000000");	// Show Blue for Explosion
		}
		li.appendTo("#map-info-ul");
	}
}