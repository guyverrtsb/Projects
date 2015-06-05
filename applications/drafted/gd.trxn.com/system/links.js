$(document).ready(function()
{
    $.post("/json/links.php", function(json)
    {
        json = eval("(" + json + ")");
        var liNI = $("<li/>").addClass("dropdown");
        // <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
        
        liNI.append($("<a/>").attr("href", "#").addClass("dropdown-toggle")
        	.attr("data-toggle", "dropdown").attr("role", "button")
        	.attr("aria-expanded", "false")
        	.html("GD&nbsp;System&nbsp;<span class=\"caret\"></span>"));
    	
        // <ul class="dropdown-menu" role="menu">
        var gdSysMI = $("<ul/>").addClass("dropdown-menu").attr("role", "menu");

        $.each(json.URLINKS, function(key, val)
        {
            var d = json.URLINKS[key].display;
            var u = json.URLINKS[key].url;
            var item = $("<li/>").append($("<a/>", {href:u}).text(d));
            gdSysMI.append(item);
        });
        
        // <li class="divider"></li>
        gdSysMI.append($("<li/>").addClass("divider"));
        
        $.each(json.SYS_SITE_VARIABLES, function(key, val)
        {
            var d = json.SYS_SITE_VARIABLES[key].display;
            var u = json.SYS_SITE_VARIABLES[key].value;
            var item = $("<li/>").append($("<a/>", {href:"#"}).text(d + ":" + u));
            gdSysMI.append(item);
        });
        
        $("#gdtrxncomnav").append(liNI.append(gdSysMI));
    });
});