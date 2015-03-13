function zBattleFieldObjectHAZARD(zObjectBattleMap, objectType, type)
{
    var whoplaced = type.whoplaced;
    var lat = type.lat;
    var lng = type.lng;
    var zidx = type.zidx;
    var icon = type.icon;
    var range = type.range;
    
    var marker = new google.maps.Marker(
    {
        position: new google.maps.LatLng(lat, lng),
        map: zObjectBattleMap,
        icon: {
            url: "/mimes/images/hazard/" + icon + ".png",
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
        title: whoplaced,
        zIndex: zidx,
        zMarkerType:objectType,
        zMarkerEffectiveRange:range,
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
    return marker;
}

function zBattleFieldObjectSANCTUARY(zObjectBattleMap, objectType, type)
{
    var whoplaced = type.whoplaced;
    var lat = type.lat;
    var lng = type.lng;
    var zidx = type.zidx;
    var icon = type.icon;
    var range = type.range;
    
    var marker = new google.maps.Marker(
    {
        position: new google.maps.LatLng(lat, lng),
        map: zObjectBattleMap,
        icon: {
            url: "/mimes/images/sanctuary/" + icon + ".png",
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
        title: whoplaced,
        zIndex: zidx,
        zMarkerType:objectType,
        zMarkerEffectiveRange:range,
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
    		},
		zMarkerVisibleableRange: function ()
			{
				var populationOptions = {
					strokeColor: '#489A4F',
					strokeOpacity: 0.8,
					strokeWeight: 2,
					fillColor: '#489A4F',
					fillOpacity: 0.50,
					map: zObjectBattleMap,
					center: this.position,
					radius: this.zMarkerEffectiveRange
				};
				new google.maps.Circle(populationOptions);
			}
    });
    marker.zMarkerVisibleableRange();
    return marker;
}