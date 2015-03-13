var zObjectBattleMapMarkers = Array();

$(document).ready(function()
{
	zControlBattleMapUpdate();
    $.post("/json/hazards.php", function(json)
    {
        json = eval("(" + json + ")");
        $.each(json, function(key, val)
        {
            var hazardType = eval("json." + key);
            $.each(hazardType, function(key, val)
            {
                var whosent = hazardType[key].whosent;
                var lat = hazardType[key].lat;
                var lng = hazardType[key].lng;
                var zidx = hazardType[key].zidx;
                var icon = hazardType[key].icon;
                
                var marker = new google.maps.Marker(
                {
                    position: new google.maps.LatLng(lat, lng),
                    map: zObjectBattleMap,
                    icon: {
                        url: "/mimes/images/hazards/" + icon + ".png",
                        // This marker is 20 pixels wide by 32 pixels tall.
                        size: new google.maps.Size(16, 16),
                        // The origin for this image is 0,0.
                        origin: new google.maps.Point(0,0),
                        // The anchor for this image is the base of the flagpole at 0,32.
                        anchor: new google.maps.Point(8, 8)
                    },
                    shape: {
                        coords: [1, 1, 1, 16, 16, 16, 16 , 1],
                        type: "poly"
                    },
                    title: whosent,
                    zIndex: zidx,
                    zMarkerType:"HAZARD",
                    zMarkerEffectiveRange:20,
                    zMarkerDistanceToGamer: function ()
	                    {
	                    	var mrkrLat = lat;
	                    	var mrkrLng = lng;
	                    	var gamrLat = zObjectBattleMapLatLng["gamrLat"];
	                    	var gamrLng = zObjectBattleMapLatLng["gamrLng"];
	                    	
							var R = 6371; // Radius of the earth in km
							var dLat = ((mrkrLat-gamrLat) * (Math.PI/180));  // deg2rad below
							var dLon = ((mrkrLng-gamrLng) * (Math.PI/180));  // deg2rad below
							var a = 
								Math.sin(dLat/2) * Math.sin(dLat/2) +
								Math.cos(mrkrLat * (Math.PI/180)) * Math.cos(gamrLat * (Math.PI/180)) * 
								Math.sin(dLon/2) * Math.sin(dLon/2)
							;
							var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
							var d = R * c; // Distance in km
							return d * 1000;
	                    },
                	zMarkerIsGamerInRangeData: function ()
                		{
	                		if((this.zMarkerDistanceToGamer() - this.zMarkerEffectiveRange) <= 0)
	                			return true;
	                		return false;
                		},
                	zMarkerGamerInRangeData: function ()
                		{
                			return this.zMarkerDistanceToGamer() + ":" + this.zMarkerDistanceToGamer() + ":" + (this.zMarkerDistanceToGamer() - this.zMarkerEffectiveRange);
                		}
                });
                zObjectBattleMapMarkers[zObjectBattleMapMarkers.length] = marker;
            });
        });
    });
});

var zObjectBattleMap = null;    // Global Object for the Battle Map
var zObjectBattleMapGamer = null;   // Global Object for Gamer Icon on Map
var zControlBattleMapInterval = null;   // GLobal Object for the Interval Control to RE-CEnter Map on Gamer
var zObjectBattleMapLatLng = new Array();   // Global Object that Tracks the Center Position for the Gamer.

/**
 * Create the Control for the Gamer Map.  This is the Initializer.
 * It is important to only call this mehtod once.  Afterwards use
 * the  zControlGamerMapCenter to ensure the map is centered around
 * Gamer.  Thus making the Gamer the center of the World
 */
function zControlBattleMapInitialze(position)
{
    zControlGamerUI('map-canvas');
    
    zObjectBattleMapLatLng["gamrLat"] = position.coords.latitude;
    zObjectBattleMapLatLng["gamrLng"] = position.coords.longitude;
    
    var mapOptions = {
        center: { lat: zObjectBattleMapLatLng["gamrLat"], lng: zObjectBattleMapLatLng["gamrLng"]},
        zoom: 18	/* 1(World Views) - 20(Tight View)*/
    };
    
    zObjectBattleMap = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
    
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
 * Used in tandom with a Set Interval this method will ensure the
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
    var message = {
    	    code: 0, 
    	    message: "Good Map Status"
    	};
    zControlGamerMapStatus(message);
}

/**
 * Use this to launch the Battle Map for the Gamer. This 
 * method will Initialize the Battle Map and then
 * execute the Interval so the map will stay centered
 * around the Gamer 
 */
function zControlBattleMapUpdate()
{
    if (navigator.geolocation) 
    {
        navigator.geolocation.getCurrentPosition(zControlBattleMapInitialze, 
        		zControlGamerMapStatus,
            { enableHighAccuracy: true/*, timeout: 1000*/, maximumAge: 0 }
        );

        //zControlBattleMapInterval = setInterval(function()
        //{
            navigator.geolocation.watchPosition(zControlBattleMapFollowGamer, 
            		zControlGamerMapStatus,
                { enableHighAccuracy: true/*, timeout: 1000*/, maximumAge: 0 }
            );
            
        //}, 2000);
    }
    else
    { 
        var date = new Date();
        document.getElementById("map-info-date").innerHTML = "DATE_TIME:{" + date.getTime() + "}:";
        document.getElementById("map-info-error").innerHTML = "ERROR:{Geo location is not allowed on this Browser}:";
    }
}

function zControlGamerUI(mapCanvasId)
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
 *Use this to display various error message with regards to the
 * Gamer Position and Battle Map 
 */
function zControlGamerMapStatus(status)
{
    var date = new Date();
    document.getElementById("map-info-date").innerHTML = "DATE_TIME:{" + date.getTime() + "}:";
    document.getElementById("map-info-status").innerHTML = "CODE:{" + status.code + "}:MESSAGE:{" + status.message + "}";
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
			li.css("background-color", "#ff0000").css("color", "#ffffff");	// Show Red for Explosion
		else
			li.css("background-color", "#00ff00").css("color", "#000000");	// Show Green for Safe
		li.appendTo("#map-info-ul");
	}
}