<?php
$tblkey = filter_var($_GET["GD_REQ_KEY_JSON_TABLENAME"], FILTER_SANITIZE_STRING);
if(tblkey.equalsIgnoreCase("reg_sales_country"))
{?>
{
    "reg_sales_country" :
    [
    { "id":"US", "val":"United States" },
    { "id":"CN", "val":"Canada" }
    ]
}
<?php } ?>
<?php if(tblkey.equalsIgnoreCase("reg_sales_mgr"))
{?>
{
    "reg_sales_mgr" :
    [
    { "id":"001", "val":"Boyle" },
    { "id":"002", "val":"Butler" },
    { "id":"003", "val":"McCarthy" },
    { "id":"004", "val":"Pochocki" },
    { "id":"005", "val":"Grayson" },
    { "id":"006", "val":"Garner" }
    ]
}
<?php } ?>
<?php if(tblkey.equalsIgnoreCase("order_header_qty"))
{?>
{
    "order_header_qty" :
    [
    { "id":"001", "val":"1" },
    { "id":"002", "val":"2" },
    { "id":"003", "val":"3" },
    { "id":"004", "val":"4" },
    { "id":"005", "val":"5" },
    { "id":"006", "val":"6" },
    { "id":"007", "val":"7" },
    { "id":"008", "val":"8" }
    ]
}
<?php } ?>
<?php if(tblkey.equalsIgnoreCase("paint_cab_stripe"))
{?>
{
    "paint_cab_stripe" :
    [
    { "id":"001", "val":"No" },
    { "id":"002", "val":"(1) 3 in." },
    { "id":"003", "val":"(2) 3 in." },
    { "id":"004", "val":"(3) 3 in." },
    { "id":"005", "val":"(1) 4 in." },
    { "id":"006", "val":"(2) 4 in." },
    { "id":"007", "val":"(3) 4 in." }
    ]
}
<?php } ?>
<?php if(tblkey.equalsIgnoreCase("paint_bumper_stripe"))
{?>
{
    "paint_bumper_stripe" :
    [
    { "id":"001", "val":"No" },
    { "id":"002", "val":"Yes" }
    ]
}
<?php } ?>
<?php if(tblkey.equalsIgnoreCase("paint_front_wheels"))
{?>
{
    "paint_front_wheels" :
    [
    { "id":"001", "val":"1-Sided" },
    { "id":"002", "val":"2-Sided" }
    ]
}
<?php } ?>
<?php if(tblkey.equalsIgnoreCase("paint_rear_wheels"))
{?>
{
    "paint_rear_wheels" :
    [
    { "id":"001", "val":"1-Sided" },
    { "id":"002", "val":"2-Sided" }
    ]
}
<?php } ?>
<?php if(tblkey.equalsIgnoreCase("drive_away_charges"))
{?>
{
    "drive_away_charges" :
    [
    { "id":"single", "val":"Single" },
    { "id":"double", "val":"Double" },
    { "id":"triple", "val":"Triple" },
    { "id":"hual", "val":"Haul" },
    { "id":"hsingle", "val":"Single" },
    { "id":"hdouble", "val":"Double" }
    ]
}
<?php } ?>
<?php if(tblkey.equalsIgnoreCase("drive_away_locations"))
{?>
{
    "drive_away_locations" :
    [
    { "id":"001", "val":"ALABAMA", "mileage":"", "single":"", "double":"", "triple":"", "hsingle":"", "hdouble":"" },
    { "id":"001", "val":"Birmingham, AL (VacAll)", "mileage":"665", "single":"1796", "double":"1398", "triple":"1048", "hsingle":"2728", "hdouble":"1364" },
    { "id":"001", "val":"Ft. Payne, AL (Heil)", "mileage":"750", "single":"2025", "double":"1113", "triple":"888", "hsingle":"3025", "hdouble":"1513" },
    { "id":"001", "val":"Huntsville, AL (Schwarze)", "mileage":"620", "single":"1674", "double":"1137", "triple":"901", "hsingle":"2570", "hdouble":"1285" },
    { "id":"001", "val":"ALASKA", "mileage":"", "single":"", "double":"", "triple":"", "hsingle":"", "hdouble":"" },
    { "id":"001", "val":"Anchorage", "mileage":"3845", "single":"N/A", "double":"N/A", "triple":"N/A", "hsingle":"N/A", "hdouble":"N/A" },
    { "id":"001", "val":"ARIZONA", "mileage":"", "single":"", "double":"", "triple":"", "hsingle":"", "hdouble":"" },
    { "id":"001", "val":"Phoenix, AZ", "mileage":"1115", "single":"3011", "double":"1605", "triple":"1271", "hsingle":"4103", "hdouble":"2052" },
    { "id":"001", "val":"Tucson, AZ", "mileage":"1105", "single":"2984", "double":"1592", "triple":"1260", "hsingle":"4068", "hdouble":"2034" },
    { "id":"001", "val":"ARKANSAS", "mileage":"", "single":"", "double":"", "triple":"", "hsingle":"", "hdouble":"" },
    { "id":"001", "val":"Fayetteville, AR", "mileage":"125", "single":"500", "double":"400", "triple":"300", "hsingle":"638", "hdouble":"319" },
    { "id":"001", "val":"Hot Springs, AR", "mileage":"240", "single":"648", "double":"450", "triple":"400", "hsingle":"1040", "hdouble":"520" },
    { "id":"001", "val":"Little Rock, AR", "mileage":"275", "single":"743", "double":"471", "triple":"400", "hsingle":"1163", "hdouble":"582" },
    { "id":"001", "val":"CALIFORNIA", "mileage":"", "single":"", "double":"", "triple":"", "hsingle":"", "hdouble":"" },
    { "id":"001", "val":"Corona, CA (Edge)", "mileage":"1430", "single":"3861", "double":"2588", "triple":"2038", "hsingle":"5405", "hdouble":"2703" },
    { "id":"001", "val":"Fontana, CA", "mileage":"1400", "single":"3780", "double":"2340", "triple":"1850", "hsingle":"5100", "hdouble":"2550" },
    { "id":"001", "val":"Fresno, CA", "mileage":"1570", "single":"4239", "double":"2612", "triple":"2063", "hsingle":"5695", "hdouble":"2848" },
    { "id":"001", "val":"Fullerton, CA", "mileage":"1435", "single":"3875", "double":"2396", "triple":"1894", "hsingle":"5223", "hdouble":"2612" },
    { "id":"001", "val":"Gardena, CA", "mileage":"1455", "single":"3929", "double":"2428", "triple":"1919", "hsingle":"5293", "hdouble":"2647" },
    { "id":"001", "val":"Huntington Beach, CA", "mileage":"1455", "single":"3929", "double":"2428", "triple":"1919", "hsingle":"5293", "hdouble":"2647" },
    { "id":"001", "val":"Huntington Park, CA", "mileage":"1450", "single":"3915", "double":"2420", "triple":"1913", "hsingle":"5275", "hdouble":"2638" },
    { "id":"001", "val":"Long Beach, CA", "mileage":"1460", "single":"3942", "double":"2436", "triple":"1925", "hsingle":"5310", "hdouble":"2655" },
    { "id":"001", "val":"Los Angeles, CA", "mileage":"1445", "single":"3902", "double":"2412", "triple":"1906", "hsingle":"5258", "hdouble":"2629" },
    { "id":"001", "val":"Newerk, CA", "mileage":"1720", "single":"4644", "double":"2852", "triple":"250", "hsingle":"6220", "hdouble":"3110" },
    { "id":"001", "val":"Ontario, CA (Amrep)", "mileage":"1410", "single":"3807", "double":"2556", "triple":"2013", "hsingle":"5335", "hdouble":"2668" },
    { "id":"001", "val":"Rancho Cucamonga, CA", "mileage":"1405", "single":"3794", "double":"2348", "triple":"1856", "hsingle":"5118", "hdouble":"2559" },
    { "id":"001", "val":"Sacramento, CA", "mileage":"1750", "single":"4725", "double":"2900", "triple":"2288", "hsingle":"6325", "hdouble":"3163" },
    { "id":"001", "val":"Salinas, CA", "mileage":"1670", "single":"4509", "double":"2772", "triple":"2188", "hsingle":"6045", "hdouble":"3023" },
    { "id":"001", "val":"San Diego, CA", "mileage":"1470", "single":"3969", "double":"2452", "triple":"1938", "hsingle":"5345", "hdouble":"2673" },
    { "id":"001", "val":"San Francisco, CA", "mileage":"1745", "single":"4712", "double":"2892", "triple":"2281", "hsingle":"6308", "hdouble":"3154" },
    { "id":"001", "val":"Santa Clara, CA", "mileage":"1710", "single":"4617", "double":"2836", "triple":"2238", "hsingle":"6185", "hdouble":"3093" },
    { "id":"001", "val":"Santa Monica, CA", "mileage":"1460", "single":"3942", "double":"2436", "triple":"1925", "hsingle":"5310", "hdouble":"2655" },
    { "id":"001", "val":"Sun Valley, CA", "mileage":"1450", "single":"3915", "double":"2620", "triple":"2063", "hsingle":"5475", "hdouble":"2738" },
    { "id":"001", "val":"Sunnyvale, CA", "mileage":"1715", "single":"3915", "double":"2420", "triple":"1913", "hsingle":"5275", "hdouble":"2638" },
    { "id":"001", "val":"West Sacramento, CA", "mileage":"1735", "single":"4631", "double":"2844", "triple":"2244", "hsingle":"6203", "hdouble":"3102" },
    { "id":"001", "val":"CANADA", "mileage":"", "single":"", "double":"", "triple":"", "hsingle":"", "hdouble":"" },
    { "id":"001", "val":"Boucherville, OC", "mileage":"1580", "single":"4516", "double":"2753", "triple":"2160", "hsingle":"6080", "hdouble":"3040" },
    { "id":"001", "val":"Brooks, AB", "mileage":"1705", "single":"N/A", "double":"N/A", "triple":"N/A", "hsingle":"6518", "hdouble":"3259" },
    { "id":"001", "val":"Calgary, AB", "mileage":"1800", "single":"5110", "double":"N/A", "triple":"N/A", "hsingle":"6850", "hdouble":"3425" },
    { "id":"001", "val":"Edmonton, AB", "mileage":"1975", "single":"5583", "double":"N/A", "triple":"N/A", "hsingle":"7463", "hdouble":"3732" },
    { "id":"001", "val":"Hamilton, ON (Universal)", "mileage":"1100", "single":"3220", "double":"2185", "triple":"1710", "hsingle":"4600", "hdouble":"2300" },
    { "id":"001", "val":"Lloydminister, AB", "mileage":"1705", "single":"4854", "double":"N/A", "triple":"N/A", "hsingle":"6518", "hdouble":"3259" },
    { "id":"001", "val":"Medicine Hat, AB", "mileage":"1800", "single":"5110", "double":"3105", "triple":"2435", "hsingle":"6850", "hdouble":"3425" },
    { "id":"001", "val":"Mississauga, ON", "mileage":"1175", "single":"3423", "double":"2105", "triple":"1654", "hsingle":"4663", "hdouble":"2332" },
    { "id":"001", "val":"Red Deere, AB", "mileage":"1880", "single":"5326", "double":"N/A", "triple":"N/A", "hsingle":"7130", "hdouble":"3565" },
    { "id":"001", "val":"St. Nicholas, QC (Labrie/Leach)", "mileage":"1825", "single":"5178", "double":"3645", "triple":"2766", "hsingle":"7138", "hdouble":"3569" },
    { "id":"001", "val":"Toronto, ON", "mileage":"1175", "single":"3423", "double":"2105", "triple":"1654", "hsingle":"4663", "hdouble":"2332" },
    { "id":"001", "val":"Waterloo, ON", "mileage":"1150", "single":"3355", "double":"2065", "triple":"1623", "hsingle":"4575", "hdouble":"2288" },
    { "id":"001", "val":"Woodstock, ON", "mileage":"1050", "single":"3085", "double":"1905", "triple":"1498", "hsingle":"4225", "hdouble":"2113" },
    { "id":"001", "val":"COLORADO", "mileage":"", "single":"", "double":"", "triple":"", "hsingle":"", "hdouble":"" },
    { "id":"001", "val":"Delta, CO", "mileage":"980", "single":"2646", "double":"N/A", "triple":"N/A", "hsingle":"3630", "hdouble":"1815" },
    { "id":"001", "val":"Denver, CO", "mileage":"685", "single":"1850", "double":"1196", "triple":"956", "hsingle":"2598", "hdouble":"1299" },
    { "id":"001", "val":"CONNECTICUT", "mileage":"", "single":"", "double":"", "triple":"", "hsingle":"", "hdouble":"" },
    { "id":"001", "val":"Bridgeport, CT", "mileage":"1415", "single":"3821", "double":"2364", "triple":"1869", "hsingle":"5153", "hdouble":"2577" },
    { "id":"001", "val":"Hartford, CT", "mileage":"1480", "single":"3996", "double":"2468", "triple":"1950", "hsingle":"5380", "hdouble":"2690" },
    { "id":"001", "val":"Manchester, CT", "mileage":"1500", "single":"4050", "double":"2500", "triple":"1975", "hsingle":"5450", "hdouble":"2725" },
    { "id":"001", "val":"Middletown, CT", "mileage":"1455", "single":"3929", "double":"2428", "triple":"1919", "hsingle":"5293", "hdouble":"2647" },
    { "id":"001", "val":"New Haven, CT", "mileage":"1440", "single":"3888", "double":"2404", "triple":"1900", "hsingle":"5240", "hdouble":"2620" },
    { "id":"001", "val":"North Haven, CT", "mileage":"1450", "single":"3915", "double":"2420", "triple":"1913", "hsingle":"5275", "hdouble":"2638" },
    { "id":"001", "val":"Waterbury, CT", "mileage":"1460", "single":"3942", "double":"2436", "triple":"1925", "hsingle":"5310", "hdouble":"2655" },
    { "id":"001", "val":"DELAWARE", "mileage":"", "single":"", "double":"", "triple":"", "hsingle":"", "hdouble":"" },
    { "id":"001", "val":"Dover, DE", "mileage":"1315", "single":"3551", "double":"2204", "triple":"1744", "hsingle":"4803", "hdouble":"2402" },
    { "id":"001", "val":"Wilmington, DE", "mileage":"1270", "single":"3429", "double":"2132", "triple":"1688", "hsingle":"4645", "hdouble":"2323" },
    { "id":"001", "val":"FLORIDA", "mileage":"", "single":"", "double":"", "triple":"", "hsingle":"", "hdouble":"" },
    { "id":"001", "val":"Alachua, FL", "mileage":"1105", "single":"2984", "double":"1868", "triple":"1481", "hsingle":"4068", "hdouble":"2034" },
    { "id":"001", "val":"Daytona Beach, FL", "mileage":"1205", "single":"3254", "double":"2028", "triple":"1606", "hsingle":"4418", "hdouble":"2209" },
    { "id":"001", "val":"Ft. Myers, FL", "mileage":"1355", "single":"3659", "double":"2268", "triple":"1794", "hsingle":"1943", "hdouble":"972" },
    { "id":"001", "val":"Jacksonville, FL (Vac-Con)", "mileage":"1120", "single":"3024", "double":"2092", "triple":"1650", "hsingle":"4320", "hdouble":"2160" },
    { "id":"001", "val":"Miami, FL", "mileage":"1435", "single":"3875", "double":"2396", "triple":"1894", "hsingle":"5223", "hdouble":"2612" },
    { "id":"001", "val":"Oakland Park, FL", "mileage":"1400", "single":"3780", "double":"2340", "triple":"1850", "hsingle":"5100", "hdouble":"2550" },
    { "id":"001", "val":"Orlando, FL", "mileage":"1215", "single":"3281", "double":"2044", "triple":"1619", "hsingle":"4453", "hdouble":"2227" },
    { "id":"001", "val":"Pensacola, FL", "mileage":"780", "single":"2106", "double":"1348", "triple":"1075", "hsingle":"2930", "hdouble":"1465" },
    { "id":"001", "val":"St. Petersburg, FL", "mileage":"1255", "single":"3389", "double":"2108", "triple":"1669", "hsingle":"4593", "hdouble":"2297" },
    { "id":"001", "val":"Tallahassee, FL", "mileage":"955", "single":"2579", "double":"1628", "triple":"1294", "hsingle":"3543", "hdouble":"1772" },
    { "id":"001", "val":"Tampa, FL", "mileage":"1230", "single":"3321", "double":"2068", "triple":"1638", "hsingle":"4505", "hdouble":"2253" },
    { "id":"001", "val":"Venice, FL", "mileage":"1300", "single":"3510", "double":"2180", "triple":"1725", "hsingle":"4750", "hdouble":"2375" },
    { "id":"001", "val":"West Palm Beach, FL", "mileage":"1370", "single":"3699", "double":"2292", "triple":"1813", "hsingle":"4995", "hdouble":"2498" },
    { "id":"001", "val":"GEORGIA", "mileage":"", "single":"", "double":"", "triple":"", "hsingle":"", "hdouble":"" },
    { "id":"001", "val":"Atlanta, GA", "mileage":"805", "single":"2174", "double":"1388", "triple":"1106", "hsingle":"3018", "hdouble":"1509" },
    { "id":"001", "val":"Austell, GA", "mileage":"805", "single":"2174", "double":"1388", "triple":"1106", "hsingle":"3018", "hdouble":"1509" },
    { "id":"001", "val":"Dalton, GA", "mileage":"765", "single":"2066", "double":"1324", "triple":"1056", "hsingle":"2878", "hdouble":"1439" },
    { "id":"001", "val":"Decatur, GA", "mileage":"805", "single":"2174", "double":"1388", "triple":"1106", "hsingle":"3018", "hdouble":"1509" },
    { "id":"001", "val":"Lithia Springs, GA", "mileage":"805", "single":"2174", "double":"1388", "triple":"1106", "hsingle":"3018", "hdouble":"1509" },
    { "id":"001", "val":"Marietta, GA", "mileage":"800", "single":"2160", "double":"1380", "triple":"1100", "hsingle":"3000", "hdouble":"1500" },
    { "id":"001", "val":"Savannah, GA", "mileage":"1055", "single":"2849", "double":"1788", "triple":"1419", "hsingle":"3893", "hdouble":"1947" },
    { "id":"001", "val":"Toccoa, GA", "mileage":"895", "single":"2417", "double":"1532", "triple":"1219", "hsingle":"3333", "hdouble":"1667" },
    { "id":"001", "val":"Villa Rica, GA", "mileage":"750", "single":"2025", "double":"1300", "triple":"1038", "hsingle":"2825", "hdouble":"1413" },
    { "id":"001", "val":"HAWAII", "mileage":"", "single":"", "double":"", "triple":"", "hsingle":"", "hdouble":"" },
    { "id":"001", "val":"Honolulu", "mileage":"TBD", "single":"N/A", "double":"N/A", "triple":"N/A", "hsingle":"N/A", "hdouble":"N/A" },
    { "id":"001", "val":"IDAHO", "mileage":"", "single":"", "double":"", "triple":"", "hsingle":"", "hdouble":"" },
    { "id":"001", "val":"Boise", "mileage":"1525", "single":"4118", "double":"2540", "triple":"2006", "hsingle":"5538", "hdouble":"2769" },
    { "id":"001", "val":"ILLINOIS", "mileage":"", "single":"", "double":"", "triple":"", "hsingle":"", "hdouble":"" },
    { "id":"001", "val":"Arlington Heights, IL", "mileage":"690", "single":"1863", "double":"1204", "triple":"963", "hsingle":"2615", "hdouble":"1308" },
    { "id":"001", "val":"Champaign, IL", "mileage":"570", "single":"1539", "double":"1012", "triple":"813", "hsingle":"2195", "hdouble":"1098" },
    { "id":"001", "val":"Chicago, IL", "mileage":"690", "single":"1863", "double":"1204", "triple":"963", "hsingle":"1615", "hdouble":"808" },
    { "id":"001", "val":"Elgin, IL", "mileage":"680", "single":"1836", "double":"1388", "triple":"1100", "hsingle":"2780", "hdouble":"1390" },
    { "id":"001", "val":"Peoria, IL", "mileage":"560", "single":"1512", "double":"996", "triple":"800", "hsingle":"2160", "hdouble":"1080" },
    { "id":"001", "val":"Springfield, IL", "mileage":"490", "single":"1323", "double":"884", "triple":"713", "hsingle":"1915", "hdouble":"958" },
    { "id":"001", "val":"Streator, IL (VacAll)", "mileage":"605", "single":"1634", "double":"1468", "triple":"1106", "hsingle":"2518", "hdouble":"1259" },
    { "id":"001", "val":"INDIANA", "mileage":"", "single":"", "double":"", "triple":"", "hsingle":"", "hdouble":"" },
    { "id":"001", "val":"Evansville, IN", "mileage":"560", "single":"1512", "double":"996", "triple":"800", "hsingle":"2160", "hdouble":"1080" },
    { "id":"001", "val":"Ft. Wayne, IN", "mileage":"770", "single":"2079", "double":"1332", "triple":"1063", "hsingle":"2895", "hdouble":"1448" },
    { "id":"001", "val":"Indianapolis, IN", "mileage":"640", "single":"1728", "double":"1124", "triple":"900", "hsingle":"2440", "hdouble":"1220" },
    { "id":"001", "val":"South Bend, IN", "mileage":"755", "single":"2039", "double":"1308", "triple":"1044", "hsingle":"2843", "hdouble":"1422" },
    { "id":"001", "val":"Winamac, IN", "mileage":"720", "single":"1944", "double":"1252", "triple":"1000", "hsingle":"2720", "hdouble":"1360" },
    { "id":"001", "val":"IOWA", "mileage":"", "single":"", "double":"", "triple":"", "hsingle":"", "hdouble":"" },
    { "id":"001", "val":"Cedar Falls, IA (Wayne)", "mileage":"560", "single":"1512", "double":"1196", "triple":"950", "hsingle":"2360", "hdouble":"1180" },
    { "id":"001", "val":"Cedar Rapids, IA", "mileage":"560", "single":"1512", "double":"996", "triple":"800", "hsingle":"2160", "hdouble":"1080" },
    { "id":"001", "val":"Des Moines, IA", "mileage":"450", "single":"1215", "double":"820", "triple":"663", "hsingle":"1775", "hdouble":"888" },
    { "id":"001", "val":"Garner, IA", "mileage":"570", "single":"1539", "double":"1012", "triple":"813", "hsingle":"2195", "hdouble":"1098" },
    { "id":"001", "val":"Guttenberg, IA (Kann)", "mileage":"680", "single":"1836", "double":"1388", "triple":"1100", "hsingle":"2780", "hdouble":"1390" },
    { "id":"001", "val":"Scranton, IA (New Way)", "mileage":"505", "single":"1364", "double":"1108", "triple":"881", "hsingle":"2168", "hdouble":"1084" },
    { "id":"001", "val":"Waterloo, IA", "mileage":"560", "single":"1512", "double":"996", "triple":"800", "hsingle":"2160", "hdouble":"1080" },
    { "id":"001", "val":"KANSAS", "mileage":"", "single":"", "double":"", "triple":"", "hsingle":"", "hdouble":"" },
    { "id":"001", "val":"Haven, KS", "mileage":"215", "single":"N/A", "double":"N/A", "triple":"N/A", "hsingle":"953", "hdouble":"477" },
    { "id":"001", "val":"Kansas City, KS", "mileage":"250", "single":"675", "double":"500", "triple":"413", "hsingle":"1075", "hdouble":"538" },
    { "id":"001", "val":"Lawrence, KS", "mileage":"230", "single":"621", "double":"468", "triple":"400", "hsingle":"1005", "hdouble":"503" },
    { "id":"001", "val":"Lyons, KS", "mileage":"255", "single":"689", "double":"508", "triple":"419", "hsingle":"1093", "hdouble":"547" },
    { "id":"001", "val":"Olathe, KS", "mileage":"220", "single":"600", "double":"452", "triple":"400", "hsingle":"970", "hdouble":"485" },
    { "id":"001", "val":"Salina, KS", "mileage":"265", "single":"716", "double":"524", "triple":"431", "hsingle":"1128", "hdouble":"498" },
    { "id":"001", "val":"Wichita, KS", "mileage":"185", "single":"600", "double":"450", "triple":"400", "hsingle":"848", "hdouble":"424" },
    { "id":"001", "val":"KENTUCKY", "mileage":"", "single":"", "double":"", "triple":"", "hsingle":"", "hdouble":"" },
    { "id":"001", "val":"Bowling Green, KY", "mileage":"680", "single":"1836", "double":"1188", "triple":"940", "hsingle":"2580", "hdouble":"1290" },
    { "id":"001", "val":"Cythiana, KY (E-Z Pack)", "mileage":"740", "single":"1998", "double":"1284", "triple":"1025", "hsingle":"2990", "hdouble":"1495" },
    { "id":"001", "val":"Lexington, KY", "mileage":"730", "single":"1971", "double":"1268", "triple":"1013", "hsingle":"2755", "hdouble":"1378" },
    { "id":"001", "val":"Louisville, KY", "mileage":"650", "single":"1755", "double":"1140", "triple":"913", "hsingle":"2475", "hdouble":"1238" },
    { "id":"001", "val":"LOUISIANA", "mileage":"", "single":"", "double":"", "triple":"", "hsingle":"", "hdouble":"" },
    { "id":"001", "val":"Baton Rouge, LA", "mileage":"620", "single":"1674", "double":"1092", "triple":"875", "hsingle":"2370", "hdouble":"1185" },
    { "id":"001", "val":"Bossier City, LA", "mileage":"360", "single":"972", "double":"N/A", "triple":"N/A", "hsingle":"14760", "hdouble":"780" },
    { "id":"001", "val":"Kenner, LA", "mileage":"705", "single":"1904", "double":"1228", "triple":"981", "hsingle":"2668", "hdouble":"1334" },
    { "id":"001", "val":"New Orleans, LA", "mileage":"705", "single":"1904", "double":"1228", "triple":"981", "hsingle":"2668", "hdouble":"1334" },
    { "id":"001", "val":"MAINE", "mileage":"", "single":"", "double":"", "triple":"", "hsingle":"", "hdouble":"" },
    { "id":"001", "val":"Bangor, ME", "mileage":"1805", "single":"4874", "double":"2988", "triple":"2356", "hsingle":"6518", "hdouble":"3259" },
    { "id":"001", "val":"MARYLAND", "mileage":"", "single":"", "double":"", "triple":"", "hsingle":"", "hdouble":"" },
    { "id":"001", "val":"Baltimore, MD", "mileage":"1235", "single":"3335", "double":"2076", "triple":"1644", "hsingle":"4523", "hdouble":"2262" },
    { "id":"001", "val":"MASSACHUSETTS", "mileage":"", "single":"", "double":"", "triple":"", "hsingle":"", "hdouble":"" },
    { "id":"001", "val":"Boston, MA", "mileage":"1575", "single":"4253", "double":"2620", "triple":"2069", "hsingle":"5713", "hdouble":"2857" },
    { "id":"001", "val":"MICHIGAN", "mileage":"", "single":"", "double":"", "triple":"", "hsingle":"", "hdouble":"" },
    { "id":"001", "val":"Detroit-Troy, MI", "mileage":"945", "single":"2552", "double":"1612", "triple":"1281", "hsingle":"3508", "hdouble":"1754" },
    { "id":"001", "val":"Grand Rapids, MI", "mileage":"835", "single":"2255", "double":"1436", "triple":"1144", "hsingle":"3123", "hdouble":"1562" },
    { "id":"001", "val":"Kingsford, MI (Lodal)", "mileage":"980", "single":"2646", "double":"1868", "triple":"1475", "hsingle":"3830", "hdouble":"1915" },
    { "id":"001", "val":"Lansing, MI", "mileage":"875", "single":"2363", "double":"1500", "triple":"1194", "hsingle":"3263", "hdouble":"1632" },
    { "id":"001", "val":"Norway, MI (Loadmaster)", "mileage":"975", "single":"2633", "double":"1860", "triple":"1469", "hsingle":"3813", "hdouble":"1907" },
    { "id":"001", "val":"MINNESOTA", "mileage":"", "single":"", "double":"", "triple":"", "hsingle":"", "hdouble":"" },
    { "id":"001", "val":"Dodge Center, MN (Mc Neilus)", "mileage":"625", "single":"1688", "double":"1300", "triple":"1031", "hsingle":"2588", "hdouble":"1294" },
    { "id":"001", "val":"Fairmont, MN", "mileage":"655", "single":"1769", "double":"1148", "triple":"919", "hsingle":"2493", "hdouble":"1247" },
    { "id":"001", "val":"Minneapolis, MN - St. Paul", "mileage":"700", "single":"1890", "double":"1220", "triple":"975", "hsingle":"2650", "hdouble":"1325" },
    { "id":"001", "val":"MISSISSIPPI", "mileage":"", "single":"", "double":"", "triple":"", "hsingle":"", "hdouble":"" },
    { "id":"001", "val":"Columbia, MS", "mileage":"700", "single":"1890", "double":"N/A", "triple":"N/A", "hsingle":"2650", "hdouble":"1325" },
    { "id":"001", "val":"Jackson, MS", "mileage":"610", "single":"1647", "double":"1076", "triple":"863", "hsingle":"2335", "hdouble":"1168" },
    { "id":"001", "val":"Tishomingo, MS", "mileage":"475", "single":"1283", "double":"860", "triple":"694", "hsingle":"1863", "hdouble":"932" },
    { "id":"001", "val":"MISSOURI", "mileage":"", "single":"", "double":"", "triple":"", "hsingle":"", "hdouble":"" },
    { "id":"001", "val":"Columbia, MO", "mileage":"350", "single":"945", "double":"660", "triple":"538", "hsingle":"1425", "hdouble":"713" },
    { "id":"001", "val":"Kansas City, MO", "mileage":"250", "single":"675", "double":"500", "triple":"413", "hsingle":"1075", "hdouble":"538" },
    { "id":"001", "val":"St. Louis, MO", "mileage":"390", "single":"1053", "double":"724", "triple":"588", "hsingle":"1565", "hdouble":"783" },
    { "id":"001", "val":"Montana", "mileage":"", "single":"", "double":"", "triple":"", "hsingle":"", "hdouble":"" },
    { "id":"001", "val":"Billings, MT", "mileage":"3362", "single":"3662", "double":"2092", "triple":"1656", "hsingle":"4558", "hdouble":"2279" },
    { "id":"001", "val":"Helena, MT", "mileage":"4010", "single":"4010", "double":"2476", "triple":"1956", "hsingle":"5398", "hdouble":"2699" },
    { "id":"001", "val":"Nebraska", "mileage":"", "single":"", "double":"", "triple":"", "hsingle":"", "hdouble":"" },
    { "id":"001", "val":"Omaha, NE", "mileage":"460", "single":"1242", "double":"836", "triple":"675", "hsingle":"1810", "hdouble":"905" },
    { "id":"001", "val":"NEVADA", "mileage":"", "single":"", "double":"", "triple":"", "hsingle":"", "hdouble":"" },
    { "id":"001", "val":"Las Vegas, NV", "mileage":"1225", "single":"3308", "double":"2060", "triple":"1631", "hsingle":"4488", "hdouble":"2244" },
    { "id":"001", "val":"Reno, NV", "mileage":"1720", "single":"4644", "double":"2852", "triple":"2250", "hsingle":"6220", "hdouble":"3110" },
    { "id":"001", "val":"NEW HAMPSHIRE", "mileage":"", "single":"", "double":"", "triple":"", "hsingle":"", "hdouble":"" },
    { "id":"001", "val":"Claremont, NH", "mileage":"1665", "single":"4496", "double":"2764", "triple":"2181", "hsingle":"6028", "hdouble":"3014" },
    { "id":"001", "val":"NEW JERSEY", "mileage":"", "single":"", "double":"", "triple":"", "hsingle":"", "hdouble":"" },
    { "id":"001", "val":"Hillside, NJ", "mileage":"1335", "single":"3605", "double":"2236", "triple":"1769", "hsingle":"4873", "hdouble":"2437" },
    { "id":"001", "val":"Howell, NJ", "mileage":"1320", "single":"3564", "double":"2212", "triple":"1750", "hsingle":"4820", "hdouble":"2410" },
    { "id":"001", "val":"Lodi, NJ", "mileage":"1350", "single":"3645", "double":"2260", "triple":"1788", "hsingle":"4925", "hdouble":"2463" },
    { "id":"001", "val":"North Brunswick, NJ", "mileage":"1350", "single":"3645", "double":"2260", "triple":"1788", "hsingle":"4925", "hdouble":"2463" },
    { "id":"001", "val":"Paramus, NJ", "mileage":"1350", "single":"3645", "double":"2260", "triple":"1788", "hsingle":"4925", "hdouble":"2463" },
    { "id":"001", "val":"NEW MEXICO", "mileage":"", "single":"", "double":"", "triple":"", "hsingle":"", "hdouble":"" },
    { "id":"001", "val":"Albuquerque, NM", "mileage":"650", "single":"1755", "double":"1140", "triple":"913", "hsingle":"2475", "hdouble":"1238" },
    { "id":"001", "val":"Hobbs, NM", "mileage":"605", "single":"1634", "double":"N/A", "triple":"N/A", "hsingle":"2318", "hdouble":"1159" },
    { "id":"001", "val":"NEW YORK", "mileage":"", "single":"", "double":"", "triple":"", "hsingle":"", "hdouble":"" },
    { "id":"001", "val":"Albany, NY", "mileage":"1450", "single":"3915", "double":"2420", "triple":"1913", "hsingle":"5275", "hdouble":"2638" },
    { "id":"001", "val":"Bronx, NY", "mileage":"1380", "single":"3726", "double":"2308", "triple":"1825", "hsingle":"5030", "hdouble":"2515" },
    { "id":"001", "val":"Buffalo, NY", "mileage":"1145", "single":"3092", "double":"1932", "triple":"1531", "hsingle":"4208", "hdouble":"2104" },
    { "id":"001", "val":"Ellenville, NY", "mileage":"1400", "single":"3780", "double":"2340", "triple":"1850", "hsingle":"5100", "hdouble":"2550" },
    { "id":"001", "val":"New York, NY", "mileage":"1380", "single":"3726", "double":"2308", "triple":"1825", "hsingle":"5030", "hdouble":"2515" },
    { "id":"001", "val":"Rochester, NY", "mileage":"1215", "single":"3281", "double":"2044", "triple":"1619", "hsingle":"4453", "hdouble":"2227" },
    { "id":"001", "val":"Springville, NY", "mileage":"1115", "single":"3011", "double":"1884", "triple":"1494", "hsingle":"4103", "hdouble":"2052" },
    { "id":"001", "val":"Syracuse, NY", "mileage":"1280", "single":"3456", "double":"2148", "triple":"1700", "hsingle":"4680", "hdouble":"2340" },
    { "id":"001", "val":"NORTH CAROLINA", "mileage":"", "single":"", "double":"", "triple":"", "hsingle":"", "hdouble":"" },
    { "id":"001", "val":"Charlotte, NC", "mileage":"1035", "single":"2795", "double":"1756", "triple":"1394", "hsingle":"3823", "hdouble":"1912" },
    { "id":"001", "val":"Durham, NC", "mileage":"1125", "single":"3038", "double":"1900", "triple":"1506", "hsingle":"4138", "hdouble":"2069" },
    { "id":"001", "val":"Fayetteville, NC", "mileage":"1175", "single":"3173", "double":"1980", "triple":"1569", "hsingle":"4313", "hdouble":"2157" },
    { "id":"001", "val":"Greensboro, NC", "mileage":"1075", "single":"2903", "double":"1820", "triple":"1444", "hsingle":"3963", "hdouble":"1982" },
    { "id":"001", "val":"Raleigh, NC", "mileage":"1155", "single":"3119", "double":"1948", "triple":"1544", "hsingle":"4243", "hdouble":"2122" },
    { "id":"001", "val":"Statesville, NC", "mileage":"995", "single":"2687", "double":"1692", "triple":"1344", "hsingle":"3683", "hdouble":"1842" },
    { "id":"001", "val":"Wilson, NC", "mileage":"1270", "single":"3429", "double":"2132", "triple":"1688", "hsingle":"4645", "hdouble":"2323" },
    { "id":"001", "val":"Winston-Salem, NC", "mileage":"1050", "single":"2835", "double":"1780", "triple":"1413", "hsingle":"3875", "hdouble":"1938" },
    { "id":"001", "val":"NORTH DAKOTA", "mileage":"", "single":"", "double":"", "triple":"", "hsingle":"", "hdouble":"" },
    { "id":"001", "val":"Fargo", "mileage":"880", "single":"2376", "double":"1508", "triple":"1200", "hsingle":"3280", "hdouble":"1640" },
    { "id":"001", "val":"Kenmare", "mileage":"1190", "single":"3213", "double":"N/A", "triple":"N/A", "hsingle":"4365", "hdouble":"2183" },
    { "id":"001", "val":"OHIO", "mileage":"", "single":"", "double":"", "triple":"", "hsingle":"", "hdouble":"" },
    { "id":"001", "val":"Bryan, OH", "mileage":"825", "single":"2228", "double":"1420", "triple":"1131", "hsingle":"3088", "hdouble":"1544" },
    { "id":"001", "val":"Cincinnati, OH", "mileage":"745", "single":"2012", "double":"1292", "triple":"1031", "hsingle":"2808", "hdouble":"1404" },
    { "id":"001", "val":"Cleveland, OH", "mileage":"955", "single":"2579", "double":"1628", "triple":"1294", "hsingle":"3543", "hdouble":"1772" },
    { "id":"001", "val":"Columbus, OH", "mileage":"815", "single":"2201", "double":"1404", "triple":"1119", "hsingle":"3053", "hdouble":"1527" },
    { "id":"001", "val":"Dayton, OH", "mileage":"750", "single":"2025", "double":"1300", "triple":"1038", "hsingle":"2825", "hdouble":"1413" },
    { "id":"001", "val":"Galion, OH", "mileage":"860", "single":"2322", "double":"1476", "triple":"1175", "hsingle":"3210", "hdouble":"1605" },
    { "id":"001", "val":"Toledo", "mileage":"OH", "single":"860", "double":"2322", "triple":"1476", "hsingle":"1175", "hdouble":"3210,1390" },
    { "id":"001", "val":"OKLAHOMA", "mileage":"", "single":"", "double":"", "triple":"", "hsingle":"", "hdouble":"" },
    { "id":"001", "val":"Catoosa, OK", "mileage":"15", "single":"85", "double":"N/A", "triple":"N/A", "hsingle":"350", "hdouble":"175" },
    { "id":"001", "val":"Durant, OK", "mileage":"165", "single":"600", "double":"450", "triple":"400", "hsingle":"778", "hdouble":"389" },
    { "id":"001", "val":"Enid, OK", "mileage":"125", "single":"500", "double":"N/A", "triple":"N/A", "hsingle":"638", "hdouble":"319" },
    { "id":"001", "val":"Fairview, OK (Pendpac / Impac)", "mileage":"170", "single":"600", "double":"572", "triple":"463", "hsingle":"995", "hdouble":"498" },
    { "id":"001", "val":"Okemah, OK", "mileage":"75", "single":"500", "double":"N/A", "triple":"N/A", "hsingle":"N/A", "hdouble":"N/A" },
    { "id":"001", "val":"Oklahoma City, OK", "mileage":"105", "single":"500", "double":"400", "triple":"300", "hsingle":"568", "hdouble":"284" },
    { "id":"001", "val":"OREGON", "mileage":"", "single":"", "double":"", "triple":"", "hsingle":"", "hdouble":"" },
    { "id":"001", "val":"Portland, OR", "mileage":"1950", "single":"5265", "double":"3220", "triple":"2538", "hsingle":"7025", "hdouble":"3513" },
    { "id":"001", "val":"Salem, OR", "mileage":"2000", "single":"5400", "double":"3300", "triple":"2600", "hsingle":"7200", "hdouble":"3600" },
    { "id":"001", "val":"PENNSYLVANIA", "mileage":"", "single":"", "double":"", "triple":"", "hsingle":"", "hdouble":"" },
    { "id":"001", "val":"Franklin, PA", "mileage":"1040", "single":"2808", "double":"1764", "triple":"1400", "hsingle":"3840", "hdouble":"1920" },
    { "id":"001", "val":"Harrisburg, PA", "mileage":"1190", "single":"3213", "double":"2004", "triple":"1588", "hsingle":"4365", "hdouble":"2183" },
    { "id":"001", "val":"Philadelphia, PA", "mileage":"1295", "single":"3497", "double":"2172", "triple":"1719", "hsingle":"4733", "hdouble":"2367" },
    { "id":"001", "val":"Pittsburgh, PA", "mileage":"1005", "single":"2714", "double":"1708", "triple":"1356", "hsingle":"3718", "hdouble":"1859" },
    { "id":"001", "val":"Somerset, PA (G-S)", "mileage":"1070", "single":"2889", "double":"2012", "triple":"1588", "hsingle":"4145", "hdouble":"2073" },
    { "id":"001", "val":"West Chester", "mileage":"1255", "single":"N/A", "double":"N/A", "triple":"N/A", "hsingle":"4593", "hdouble":"2297" },
    { "id":"001", "val":"RHODE ISLAND", "mileage":"", "single":"", "double":"", "triple":"", "hsingle":"", "hdouble":"" },
    { "id":"001", "val":"Providence, RI", "mileage":"1545", "single":"4172", "double":"2572", "triple":"2031", "hsingle":"5608", "hdouble":"2804" },
    { "id":"001", "val":"SOUTH CAROLINA", "mileage":"", "single":"", "double":"", "triple":"", "hsingle":"", "hdouble":"" },
    { "id":"001", "val":"Charleston, SC", "mileage":"1165", "single":"3146", "double":"1964", "triple":"1556", "hsingle":"4278", "hdouble":"2139" },
    { "id":"001", "val":"Greenville, SC", "mileage":"960", "single":"2592", "double":"1636", "triple":"1300", "hsingle":"3560", "hdouble":"1780" },
    { "id":"001", "val":"SOUTH DAKOTA", "mileage":"", "single":"", "double":"", "triple":"", "hsingle":"", "hdouble":"" },
    { "id":"001", "val":"Madison, SD", "mileage":"630", "single":"1701", "double":"1108", "triple":"888", "hsingle":"2405", "hdouble":"1203" },
    { "id":"001", "val":"Rapid City, SD", "mileage":"880", "single":"2376", "double":"1508", "triple":"1200", "hsingle":"3280", "hdouble":"1640" },
    { "id":"001", "val":"TENNESSEE", "mileage":"", "single":"", "double":"", "triple":"", "hsingle":"", "hdouble":"" },
    { "id":"001", "val":"Knoxville, TN", "mileage":"795", "single":"2147", "double":"1372", "triple":"1094", "hsingle":"2983", "hdouble":"1492" },
    { "id":"001", "val":"Memphis, TN", "mileage":"400", "single":"1080", "double":"740", "triple":"0", "hsingle":"1600", "hdouble":"800" },
    { "id":"001", "val":"Nashville, TN", "mileage":"615", "single":"1661", "double":"1084", "triple":"869", "hsingle":"2353", "hdouble":"1177" },
    { "id":"001", "val":"TEXAS", "mileage":"", "single":"", "double":"", "triple":"", "hsingle":"", "hdouble":"" },
    { "id":"001", "val":"Arlington, TX (G n H)", "mileage":"330", "single":"891", "double":"828", "triple":"663", "hsingle":"1555", "hdouble":"778" },
    { "id":"001", "val":"Austin, TX", "mileage":"460", "single":"1242", "double":"836", "triple":"675", "hsingle":"1810", "hdouble":"905" },
    { "id":"001", "val":"Blanco, TX", "mileage":"550", "single":"1485", "double":"N/A", "triple":"N/A", "hsingle":"2125", "hdouble":"1063" },
    { "id":"001", "val":"Bridgeport, TX (Bridgeport)", "mileage":"315", "single":"851", "double":"804", "triple":"644", "hsingle":"1503", "hdouble":"752" },
    { "id":"001", "val":"Dallas, TX", "mileage":"265", "single":"716", "double":"524", "triple":"431", "hsingle":"1128", "hdouble":"564" },
    { "id":"001", "val":"Denison, TX", "mileage":"185", "single":"600", "double":"450", "triple":"400", "hsingle":"848", "hdouble":"424" },
    { "id":"001", "val":"Denton, TX", "mileage":"285", "single":"770", "double":"556", "triple":"456", "hsingle":"1198", "hdouble":"599" },
    { "id":"001", "val":"El Paso, TX", "mileage":"800", "single":"2160", "double":"1380", "triple":"1100", "hsingle":"3000", "hdouble":"1500" },
    { "id":"001", "val":"Ft. Worth, TX", "mileage":"315", "single":"851", "double":"604", "triple":"494", "hsingle":"1303", "hdouble":"652" },
    { "id":"001", "val":"Garland, TX", "mileage":"260", "single":"702", "double":"516", "triple":"425", "hsingle":"1110", "hdouble":"555" },
    { "id":"001", "val":"Houston, TX", "mileage":"505", "single":"1364", "double":"908", "triple":"731", "hsingle":"1968", "hdouble":"984" },
    { "id":"001", "val":"Hutchins, TX", "mileage":"275", "single":"743", "double":"540", "triple":"444", "hsingle":"1163", "hdouble":"582" },
    { "id":"001", "val":"Irving, TX", "mileage":"320", "single":"864", "double":"612", "triple":"500", "hsingle":"1320", "hdouble":"660" },
    { "id":"001", "val":"Kilgore, TX", "mileage":"300", "single":"810", "double":"580", "triple":"475", "hsingle":"1250", "hdouble":"625" },
    { "id":"001", "val":"Midland, TX", "mileage":"550", "single":"1485", "double":"680", "triple":"788", "hsingle":"2125", "hdouble":"1063" },
    { "id":"001", "val":"Pampa, TX", "mileage":"350", "single":"9845", "double":"N/A", "triple":"N/A", "hsingle":"1425", "hdouble":"713" },
    { "id":"001", "val":"Plainview, TX", "mileage":"440", "single":"1188", "double":"804", "triple":"650", "hsingle":"1740", "hdouble":"870" },
    { "id":"001", "val":"San Antonio, TX (Pak-Mor)", "mileage":"580", "single":"1566", "double":"1028", "triple":"825", "hsingle":"2230", "hdouble":"1115" },
    { "id":"001", "val":"Seguin, TX", "mileage":"550", "single":"1485", "double":"1020", "triple":"828", "hsingle":"2325", "hdouble":"1163" },
    { "id":"001", "val":"Waco, TX", "mileage":"360", "single":"972", "double":"676", "triple":"550", "hsingle":"1460", "hdouble":"730" },
    { "id":"001", "val":"Wichita Falls, TX", "mileage":"250", "single":"675", "double":"500", "triple":"413", "hsingle":"1075", "hdouble":"538" },
    { "id":"001", "val":"UTAH", "mileage":"", "single":"", "double":"", "triple":"", "hsingle":"", "hdouble":"" },
    { "id":"001", "val":"Salt Lake City, UT", "mileage":"1200", "single":"3240", "double":"2020", "triple":"1600", "hsingle":"4400", "hdouble":"2200" },
    { "id":"001", "val":"VERMONT", "mileage":"", "single":"", "double":"", "triple":"", "hsingle":"", "hdouble":"" },
    { "id":"001", "val":"Burlington, VT", "mileage":"1530", "single":"4131", "double":"2548", "triple":"2013", "hsingle":"5555", "hdouble":"2778" },
    { "id":"001", "val":"VIRGINIA", "mileage":"", "single":"", "double":"", "triple":"", "hsingle":"", "hdouble":"" },
    { "id":"001", "val":"Arlington, VA", "mileage":"1225", "single":"3308", "double":"2060", "triple":"1631", "hsingle":"4488", "hdouble":"2244" },
    { "id":"001", "val":"Charlottesville, VA", "mileage":"1150", "single":"3105", "double":"1940", "triple":"1538", "hsingle":"4225", "hdouble":"2113" },
    { "id":"001", "val":"Cloverdale, VA", "mileage":"1050", "single":"2835", "double":"1780", "triple":"1413", "hsingle":"3875", "hdouble":"1938" },
    { "id":"001", "val":"Culpeper, VA", "mileage":"1200", "single":"3240", "double":"2020", "triple":"1600", "hsingle":"4400", "hdouble":"2200" },
    { "id":"001", "val":"Duffield, VA", "mileage":"950", "single":"2565", "double":"1620", "triple":"1288", "hsingle":"3525", "hdouble":"1763" },
    { "id":"001", "val":"Norfolk, VA", "mileage":"1305", "single":"3524", "double":"2188", "triple":"1731", "hsingle":"4768", "hdouble":"2384" },
    { "id":"001", "val":"Richmond, VA", "mileage":"1215", "single":"3281", "double":"2044", "triple":"1619", "hsingle":"4453", "hdouble":"2227" },
    { "id":"001", "val":"Roanoke, VA", "mileage":"1050", "single":"2835", "double":"1780", "triple":"1413", "hsingle":"3875", "hdouble":"1938" },
    { "id":"001", "val":"WASHINGTON", "mileage":"", "single":"", "double":"", "triple":"", "hsingle":"", "hdouble":"" },
    { "id":"001", "val":"Seattle, WA", "mileage":"1990", "single":"5373", "double":"3284", "triple":"2588", "hsingle":"7165", "hdouble":"3583" },
    { "id":"001", "val":"Spokane, WA", "mileage":"1780", "single":"4806", "double":"2948", "triple":"2325", "hsingle":"6430", "hdouble":"3215" },
    { "id":"001", "val":"WEST VIRGINIA", "mileage":"", "single":"", "double":"", "triple":"", "hsingle":"", "hdouble":"" },
    { "id":"001", "val":"Charleston, WV", "mileage":"900", "single":"2430", "double":"1540", "triple":"1225", "hsingle":"3350", "hdouble":"1675" },
    { "id":"001", "val":"WISCONSIN", "mileage":"", "single":"", "double":"", "triple":"", "hsingle":"", "hdouble":"" },
    { "id":"001", "val":"Green Bay, WI", "mileage":"880", "single":"2376", "double":"1508", "triple":"1200", "hsingle":"3280", "hdouble":"1640" },
    { "id":"001", "val":"Menomonee Falls, WI", "mileage":"760", "single":"2052", "double":"1316", "triple":"1050", "hsingle":"2860", "hdouble":"1430" },
    { "id":"001", "val":"Milwaukee, WI", "mileage":"760", "single":"2052", "double":"1316", "triple":"1050", "hsingle":"2860", "hdouble":"1430" },
    { "id":"001", "val":"Oshkosh, WI (Leach)", "mileage":"845", "single":"2282", "double":"1452", "triple":"1156", "hsingle":"3158", "hdouble":"1579" },
    { "id":"001", "val":"WYOMING", "mileage":"", "single":"", "double":"", "triple":"", "hsingle":"", "hdouble":"" },
    { "id":"001", "val":"Cheyenne, WY", "mileage":"795", "single":"2147", "double":"1372", "triple":"1094", "hsingle":"2585", "hdouble":"1293" },
    { "id":"001", "val":"Sheridan, WY", "mileage":"1115", "single":"3011", "double":"1884", "triple":"1494", "hsingle":"3545", "hdouble":"1773" }
    ]
}
<?php } ?>
<?php if(tblkey.equalsIgnoreCase("paint_cab_colors"))
{?>
{
    "paint_cab_colors" :
    [
    { "id":"", "val":"Choose", "code":"", "price":"0" },
    { "id":"black", "val":"Black", "code":"123456", "price":"STD"  },
    { "id":"darkblue", "val":"Dark Blue", "code":"234561", "price":"STD" },
    { "id":"darktan", "val":"Dark Tan", "code":"345612", "price":"STD" },
    { "id":"gray", "val":"Gray", "code":"456123", "price":"STD" },
    { "id":"green", "val":"Green", "code":"561234", "price":"STD" },
    { "id":"lightblue", "val":"Light Blue", "code":"612345", "price":"STD" },
    { "id":"lighttan", "val":"Light Tan", "code":"654321", "price":"STD" },
    { "id":"mediumblue", "val":"Medium Blue", "code":"543216", "price":"STD" },
    { "id":"orange", "val":"Orange", "code":"432165", "price":"STD" },
    { "id":"red", "val":"Red", "code":"321654", "price":"STD" },
    { "id":"white", "val":"White", "code":"216543", "price":"STD" },
    { "id":"yellow", "val":"Yellow", "code":"165432", "price":"STD" },
    { "id":"metallic", "val":"Metallic", "code":"664422", "price":"STD" }
    ]
}
<?php } ?>
<?php if(tblkey.equalsIgnoreCase("block_heater"))
{?>
{
    "<?php echo tblkey; ?>" :
    [
    { "id":"", "val":"Choose", "price":"0" },
    { "id":"001", "val":"Block Heater w/ Red Indicator Light", "price":"300" }
    ]
}
<?php } ?>
<?php if(tblkey.equalsIgnoreCase("block_heater_voltage"))
{?>
{
    "<?php echo tblkey; ?>" :
    [
    { "id":"", "val":"Choose", "price":"0" },
    { "id":"001", "val":"120v" },
    { "id":"002", "val":"240v" }
    ]
}
<?php } ?>
<?php if(tblkey.equalsIgnoreCase("cooling_system_temp"))
{?>
{
    "<?php echo tblkey; ?>" :
    [
    { "id":"", "val":"Choose", "price":"0" },
    { "id":"001", "val":"-34 F Below Zero", "price":"STD" },
    { "id":"002", "val":"-40 F Below Zero", "price":"40" },
    { "id":"003", "val":"Extended Life Coolant, Red", "price":"300" }
    ]
}
<?php } ?>
<?php if(tblkey.equalsIgnoreCase("cooling_system_temp_accessorie01"))
{?>
{
    "<?php echo tblkey; ?>" :
    [
    { "id":"", "val":"--", "price":"0" },
    { "id":"001", "val":"Remote Radiator Filler w/ Cover ", "price":"525" }
    ]
}
<?php } ?>
<?php if(tblkey.equalsIgnoreCase("air_intake"))
{?>
{
    "<?php echo tblkey; ?>" :
    [
    { "id":"", "val":"Choose", "price":"0" },
    { "id":"001", "val":"Included", "price":"654" }
    ]
}
<?php } ?>
<?php if(tblkey.equalsIgnoreCase("air_intake_accessorie01"))
{?>
{
    "<?php echo tblkey; ?>" : 
    [
    { "id":"", "val":"--", "price":"0" },
    { "id":"001", "val":"Restriction Indicator, Air Cleaner Mounted ", "price":"STD" },
    { "id":"002", "val":"Filter Minder, Dash Mounted ", "price":"80" }
    ]
}
<?php } ?>
<?php if(tblkey.equalsIgnoreCase("air_intake_accessorie02"))
{?>
{
    "<?php echo tblkey; ?>" : 
    [
    { "id":"", "val":"--", "price":"0" },
    { "id":"001", "val":"Donaldson, Pre-Cleaner ", "price":"260" },
    { "id":"002", "val":"Turbo II, Pre-Cleaner ", "price":"350" }
    ]
}
<?php } ?>
<?php if(tblkey.equalsIgnoreCase("dummy_data"))
{?>
{
    "<?php echo tblkey; ?>" : 
    [
    { "id":"", "val":"--", "price":"0" },
    { "id":"001", "val":"Part STD ", "price":"STD" },
    { "id":"001", "val":"Part 001 ", "price":"100" },
    { "id":"001", "val":"Part 002 ", "price":"200" },
    { "id":"001", "val":"Part 003 ", "price":"300" },
    { "id":"001", "val":"Part 004 ", "price":"400" },
    { "id":"001", "val":"Part 005 ", "price":"500" }
    ]
}
<?php } ?>
<?php if(tblkey.equalsIgnoreCase("order_header_model"))
{?>
{
    "order_header_model" :
    [
    { "id":"LET2-26","val":"LET2-26","price":"165700", "pcondition":"GD_CCC_BASE_PRICE" },
    { "id":"LDT2-26","val":"LDT2-26","price":"179000", "pcondition":"GD_CCC_BASE_PRICE" },
    { "id":"COE2-26","val":"COE2-26","price":"164100", "pcondition":"GD_CCC_BASE_PRICE" }
    ]
}
<?php } ?>
<?php if(tblkey.equalsIgnoreCase("model_to_engine_to_more"))
{?>
{
    "LDT2-26" :
    [
    { 
        "gdVCEngine":
        [
        { "id":"", "val":"Choose", "price":"0" },
        { "id":"CUMMINS - ISC8.3-270", "val":"CUMMINS - ISC8.3-270", "price":"234" },
        { "id":"CUMMINS - ISC8.3-300", "val":"CUMMINS - ISC8.3-300", "price":"656" },
        { "id":"CUMMINS - ISC8.3-330", "val":"CUMMINS - ISC8.3-330", "price":"54" },
        { "id":"CUMMINS - ISC8.3-350", "val":"CUMMINS - ISC8.3-350", "price":"435" },
        { "id":"CUMMINS - ISL9-345", "val":"CUMMINS - ISL9-345", "price":"345" },
        { "id":"CUMMINS - ISL9-370", "val":"CUMMINS - ISL9-370", "price":"234" },
        { "id":"CUMMINS - ISL9-380", "val":"CUMMINS - ISL9-380", "price":"7657" },
        { "id":"CUMMINS - ISX11.9-320", "val":"CUMMINS - ISX11.9-320", "price":"86" },
        { "id":"CUMMINS - ISX11.9-350", "val":"CUMMINS - ISX11.9-350", "price":"457" },
        { "id":"CUMMINS - ISX11.9-385", "val":"CUMMINS - ISX11.9-385", "price":"673" },
        { "id":"CUMMINS - ISLG-250", "val":"CUMMINS - ISLG-250", "price":"435" },
        { "id":"CUMMINS - ISLG-300", "val":"CUMMINS - ISLG-300", "price":"345" },
        { "id":"CUMMINS - ISLG-320", "val":"CUMMINS - ISLG-320", "price":"345" }
        ],
        "gdVCFrontAxel":
        [
        { "id":"", "val":"--", "price":"0" },
        { "id":"D2000F", "val":"D2000F", "price":"3234" },
        { "id":"FL 941 18K", "val":"FL 941 18K", "price":"342" },
        { "id":"FL 941 20K", "val":"FL 941 20K", "price":"54" }
        ],
        "gdVCRearAxel":
        [
        { "id":"", "val":"--", "price":"0" },
        { "id":"S26-190", "val":"S26-190", "price":"234" },
        { "id":"RS-26-185", "val":"RS-26-185", "price":"423" }
        ],
        "gdVCRearSuspension":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"PAX-262 26k w/ Shocks f/ S26-190", "val":"PAX-262 26k w/ Shocks f/ S26-190", "price":"STD" },
        {"id":"2CC 26k w/o Shocks, f/ 21k-26k Axle", "val":"2CC 26k w/o Shocks, f/ 21k-26k Axle", "price":"STD" },
        {"id":"Reyco 102CC 30k w/o Shocks, f/ 26k Axle", "val":"Reyco 102CC 30k w/o Shocks, f/ 26k Axle", "price":"34532" }
        ],
        "gdVCFrameType":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Labrie / SHU-PACK", "val":"Labrie / SHU-PACK", "price":"STD" },
        {"id":"McNeilus / Bridgeport", "val":"McNeilus / Bridgeport", "price":"STD" }
        ],
        "gdVCCabInteriorWindowsLHStyle":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Solid", "val":"Solid", "price":"525" },
        {"id":"Bi-Fold", "val":"Bi-Fold", "price":"52" },
        {"id":"Flip-Up - Fold-Back", "val":"Flip-Up / Fold-Back", "price":"2354" },
        {"id":"Flip-Up - Fold-Back n In", "val":"Flip-Up / Fold-Back and In", "price":"53" }
        ],
        "gdVCCabInteriorWindowsRHStyle":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Solid", "val":"Solid", "price":"254" },
        {"id":"Bi-Fold", "val":"Bi-Fold", "price":"235" },
        {"id":"Flip-Up - Fold-Back", "val":"Flip-Up / Fold-Back", "price":"523" }
        ],
        "gdVCFrontSuspension":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Parabolic Taper-Leaf 17k", "val":"Parabolic Taper-Leaf 17k", "price":"561" },
        {"id":"Parabolic Taper-Leaf 20k", "val":"Parabolic Taper-Leaf 20k", "price":"656" },
        {"id":"Multi-Leaf Spring 22k", "val":"Multi-Leaf Spring 22k", "price":"846" },
        {"id":"Multi-Leaf Spring 17k", "val":"Multi-Leaf Spring 17k", "price":"9846" }
        ]
    }
    ],
    "LET2-26" :
    [
    { 
        "gdVCEngine":
        [
        { "id":"", "val":"Choose", "price":"0" },
        { "id":"CUMMINS - ISC8.3-270", "val":"CUMMINS - ISC8.3-270", "price":"24135" },
        { "id":"CUMMINS - ISC8.3-300", "val":"CUMMINS - ISC8.3-300", "price":"45" },
        { "id":"CUMMINS - ISC8.3-330", "val":"CUMMINS - ISC8.3-330", "price":"3245" },
        { "id":"CUMMINS - ISC8.3-350", "val":"CUMMINS - ISC8.3-350", "price":"67" },
        { "id":"CUMMINS - ISL9-345", "val":"CUMMINS - ISL9-345", "price":"345" },
        { "id":"CUMMINS - ISL9-370", "val":"CUMMINS - ISL9-370", "price":"456" },
        { "id":"CUMMINS - ISL9-380", "val":"CUMMINS - ISL9-380", "price":"341" },
        { "id":"CUMMINS - ISX11.9-320", "val":"CUMMINS - ISX11.9-320", "price":"562" },
        { "id":"CUMMINS - ISX11.9-350", "val":"CUMMINS - ISX11.9-350", "price":"85" },
        { "id":"CUMMINS - ISX11.9-385", "val":"CUMMINS - ISX11.9-385", "price":"634" },
        { "id":"CUMMINS - ISLG-250", "val":"CUMMINS - ISLG-250", "price":"1254" },
        { "id":"CUMMINS - ISLG-300", "val":"CUMMINS - ISLG-300", "price":"8674" },
        { "id":"CUMMINS - ISLG-320", "val":"CUMMINS - ISLG-320", "price":"256" }
        ],
        "gdVCFrontAxel":
        [
        { "id":"", "val":"--", "price":"0" },
        { "id":"D2000F", "val":"D2000F", "price":"584" },
        { "id":"FL 941 18K", "val":"FL 941 18K", "price":"5" },
        { "id":"FL 941 20K", "val":"FL 941 20K", "price":"87" }
        ],
        "gdVCRearAxel":
        [
        { "id":"", "val":"--", "price":"0" },
        { "id":"S26-190", "val":"S26-190", "price":"9843" },
        { "id":"RS-26-185", "val":"RS-26-185", "price":"8" }
        ],
        "gdVCRearSuspension":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"PAX-262 26k w/ Shocks f/ S26-190", "val":"PAX-262 26k w/ Shocks f/ S26-190", "price":"STD" },
        {"id":"2CC 26k w/o Shocks, f/ 21k-26k Axle", "val":"2CC 26k w/o Shocks, f/ 21k-26k Axle", "price":"STD" },
        {"id":"Reyco 102CC 30k w/o Shocks, f/ 26k Axle", "val":"Reyco 102CC 30k w/o Shocks, f/ 26k Axle", "price":"65118" }
        ],
        "gdVCFrameType":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Labrie / SHU-PACK", "val":"Labrie / SHU-PACK", "price":"STD" },
        {"id":"McNeilus / Bridgeport", "val":"McNeilus / Bridgeport", "price":"STD" }
        ],
        "gdVCCabInteriorWindowsLHStyle":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Solid", "val":"Solid", "price":"1365" },
        {"id":"Bi-Fold", "val":"Bi-Fold", "price":"654" },
        {"id":"Flip-Up - Fold-Back", "val":"Flip-Up / Fold-Back", "price":"461" },
        {"id":"Flip-Up - Fold-Back n In", "val":"Flip-Up / Fold-Back and In", "price":"8" }
        ],
        "gdVCCabInteriorWindowsRHStyle":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Solid", "val":"Solid", "price":"651" },
        {"id":"Bi-Fold", "val":"Bi-Fold", "price":"6548" },
        {"id":"Flip-Up - Fold-Back", "val":"Flip-Up / Fold-Back", "price":"834" }
        ],
        "gdVCFrontSuspension":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Parabolic Taper-Leaf 17k", "val":"Parabolic Taper-Leaf 17k", "price":"413" },
        {"id":"Parabolic Taper-Leaf 20k", "val":"Parabolic Taper-Leaf 20k", "price":"8" },
        {"id":"Multi-Leaf Spring 22k", "val":"Multi-Leaf Spring 22k", "price":"58" },
        {"id":"Multi-Leaf Spring 17k", "val":"Multi-Leaf Spring 17k", "price":"79" }
        ]
    }
    ],
    "COE2-30" :
    [
    { 
        "gdVCEngine":
        [
        { "id":"", "val":"--", "price":"0" },
        { "id":"CUMMINS - ISC8.3-270", "val":"CUMMINS - ISC8.3-270", "price":"673" },
        { "id":"CUMMINS - ISC8.3-300", "val":"CUMMINS - ISC8.3-300", "price":"254" },
        { "id":"CUMMINS - ISC8.3-330", "val":"CUMMINS - ISC8.3-330", "price":"9885" },
        { "id":"CUMMINS - ISC8.3-350", "val":"CUMMINS - ISC8.3-350", "price":"3254" },
        { "id":"CUMMINS - ISL9-345", "val":"CUMMINS - ISL9-345", "price":"894" },
        { "id":"CUMMINS - ISL9-370", "val":"CUMMINS - ISL9-370", "price":"542" },
        { "id":"CUMMINS - ISL9-380", "val":"CUMMINS - ISL9-380", "price":"96" },
        { "id":"CUMMINS - ISX11.9-320", "val":"CUMMINS - ISX11.9-320", "price":"324" },
        { "id":"CUMMINS - ISX11.9-350", "val":"CUMMINS - ISX11.9-350", "price":"3245" },
        { "id":"CUMMINS - ISX11.9-385", "val":"CUMMINS - ISX11.9-385", "price":"234" },
        { "id":"CUMMINS - ISLG-250", "val":"CUMMINS - ISLG-250", "price":"1242" },
        { "id":"CUMMINS - ISLG-300", "val":"CUMMINS - ISLG-300", "price":"234" },
        { "id":"CUMMINS - ISLG-320", "val":"CUMMINS - ISLG-320", "price":"24" }
        ],
        "gdVCFrontAxel":
        [
        { "id":"", "val":"--", "price":"0" },
        { "id":"D2000F", "val":"D2000F", "price":"864" },
        { "id":"FL 941 18K", "val":"FL 941 18K", "price":"546" },
        { "id":"FL 941 20K", "val":"FL 941 20K", "price":"1" }
        ],
        "gdVCRearAxel":
        [
        { "id":"", "val":"Choose", "price":"0" },
        { "id":"S26-190", "val":"S26-190", "price":"547" },
        { "id":"RS-26-185", "val":"RS-26-185", "price":"998" }
        ],
        "gdVCRearSuspension":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"PAX-262 26k w/ Shocks f/ S26-190", "val":"PAX-262 26k w/ Shocks f/ S26-190", "price":"STD" },
        {"id":"2CC 26k w/o Shocks, f/ 21k-26k Axle", "val":"2CC 26k w/o Shocks, f/ 21k-26k Axle", "price":"STD" },
        {"id":"Reyco 102CC 30k w/o Shocks, f/ 26k Axle", "val":"Reyco 102CC 30k w/o Shocks, f/ 26k Axle", "price":"32" }
        ],
        "gdVCFrameType":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Labrie / SHU-PACK", "val":"Labrie / SHU-PACK", "price":"STD" },
        {"id":"McNeilus / Bridgeport", "val":"McNeilus / Bridgeport", "price":"STD" }
        ],
        "gdVCCabInteriorWindowsLHStyle":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Solid", "val":"Solid", "price":"854" },
        {"id":"Bi-Fold", "val":"Bi-Fold", "price":"321" },
        {"id":"Flip-Up - Fold-Back", "val":"Flip-Up / Fold-Back", "price":"46" },
        {"id":"Flip-Up - Fold-Back n In", "val":"Flip-Up / Fold-Back and In", "price":"84" }
        ],
        "gdVCCabInteriorWindowsRHStyle":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Solid", "val":"Solid", "price":"89" },
        {"id":"Bi-Fold", "val":"Bi-Fold", "price":"165" },
        {"id":"Flip-Up - Fold-Back", "val":"Flip-Up / Fold-Back", "price":"79" }
        ],
        "gdVCFrontSuspension":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Parabolic Taper-Leaf 17k", "val":"Parabolic Taper-Leaf 17k", "price":"1549" },
        {"id":"Parabolic Taper-Leaf 20k", "val":"Parabolic Taper-Leaf 20k", "price":"48" },
        {"id":"Multi-Leaf Spring 22k", "val":"Multi-Leaf Spring 22k", "price":"654" },
        {"id":"Multi-Leaf Spring 17k", "val":"Multi-Leaf Spring 17k", "price":"8436" }
        ]
    }
    ]
}
<?php } ?>
<?php if(tblkey.equalsIgnoreCase("engine_to_other_items"))
{?>
{
    "CUMMINS - ISC8.3-270" :
    [
    { 
        "gdVCEngineTorque":
        [
        {"val":"1150"}
        ],
        "gdVCEngineRPM":
        [
        {"val":"@ 1200 RPM"}
        ],
        "gdVCAirCompressor":
        [
        {"val":"Cummins-Wabco, 18.7 CFM"}
        ],
        "gdVCBatteryBoxMetal":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"STEEL", "val":"Steel", "price":"STD" },
        {"id":"ALUMINUM", "val":"Aluminum", "price":"STD" }
        ],
        "gdVCBatteryCapabilities":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"(3) Three GRP 31, 925 CCA Ea.", "val":"(3) Three GRP 31, 925 CCA Ea.", "price":"STD" },
        {"id":"(4) Four GRP 31, 925 CCA Ea.", "val":"(4) Four GRP 31, 925 CCA Ea.", "price":"STD" }
        ],
        "gdVCStarter":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Delco 39MT - OCP", "val":"Delco 39MT - OCP", "price":"STD" }
        ],
        "gdVCAlternator":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"BOSCH LH160, 160-Amp", "val":"BOSCH LH160, 160-Amp", "price":"STD" },
        {"id":"Delco-Remy 24SI, 160-AMP", "val":"Delco-Remy 24SI, 160-AMP", "price":"STD" },
        {"id":"BOSCH LH200, 200-Amp", "val":"BOSCH LH200, 200-Amp", "price":"STD" },
        {"id":"Leece-Neville 4863JB-200-AMP", "val":"Leece-Neville 4863JB-200-AMP", "price":"STD" }
        ],
        "gdVCFilterSeperator":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Racor 490RP10, Non-Heated", "val":"Racor 490RP10, Non-Heated", "price":"561" },
        {"id":"Racor 490RP10, Heated", "val":"Racor 490RP10, Heated", "price":"17" },
        {"id":"Fleetguard FS1000, Non-Heated", "val":"Fleetguard FS1000, Non-Heated", "price":"8636" },
        {"id":"Fleetguard FS1000, Heated", "val":"Fleetguard FS1000, Heated", "price":"4861" }
        ],
        "gdVCFuelTank":
        [
        {"id":"", "val":"--", "price":"0" },
        { "id":"Steel Tanks", "val":"Steel Tanks", "price":"5618" },
        { "id":"60 Gallon Steel Single Tank", "val":"60 Gallon Steel Single Tank", "price":"36" },
        { "id":"60 Gallon Steel Dual Tanks, 120 Gal. Total", "val":"60 Gallon Steel Dual Tanks, 120 Gal. Total", "price":"61" },
        { "id":"50 Gallon Steel Narrow Single Tank", "val":"50 Gallon Steel Narrow Single Tank", "price":"651" },
        { "id":"80 Gallon Steel Single Tank, Round", "val":"80 Gallon Steel Single Tank, Round", "price":"8" },
        { "id":"80 Gallon Steel Dual Tanks, 160 Gal. Total", "val":"80 Gallon Steel Dual Tanks, 160 Gal. Total", "price":"513" },
        { "id":"Aluminum Tanks", "val":"Aluminum Tanks", "price":"549" },
        { "id":"60 Gallon Alum. Single Tank", "val":"60 Gallon Alum. Single Tank", "price":"21" },
        { "id":"50 Gallon Alum. Dual Tanks, 100 Gal. Total", "val":"50 Gallon Alum. Dual Tanks, 100 Gal. Total", "price":"5" },
        { "id":"80 Gallon Alum. Single Tank, Round", "val":"80 Gallon Alum. Single Tank, Round", "price":"87" },
        { "id":"80 Gallon Alum. Dual Tanks, 160 Gal. Total", "val":"80 Gallon Alum. Dual Tanks, 160 Gal. Total", "price":"32" }
        ],
        "gdVCFuelTankLocation":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Standard Location", "val":"Standard Location", "price":"STD" },
        {"id":"Custom Location", "val":"Custom Location", "price":"225" }
        ],
        "gdVCFuelTankAccess01":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Protectoseal Fill Neck 2 in.", "val":"Protectoseal Fill Neck 2 in.", "price":"15" },
        {"id":"Protectoseal Fill Neck 4 in.", "val":"Protectoseal Fill Neck 4 in.", "price":"54" },
        {"id":"Anti-Siphon Fill Neck 2 in.", "val":"Anti-Siphon Fill Neck 2 in.", "price":"886" },
        {"id":"Anti-Siphon Fill Neck 4 in.", "val":"Anti-Siphon Fill Neck 4 in.", "price":"61" },
        {"id":"Locking Fuel Cap", "val":"Locking Fuel Cap", "price":"16" }
        ],
        "gdVCTransRetarderSpeed":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"3000RDS", "val":"3000RDS", "price":"16195" },
        {"id":"3500RDS", "val":"3500RDS", "price":"16195" }
        ]
    }
    ],
    "CUMMINS - ISC8.3-300" :
    [
    { 
        "gdVCEngineTorque":
        [
        {"val":"1150"}
        ],
        "gdVCEngineRPM":
        [
        {"val":"@ 1800 RPM"}
        ],
        "gdVCAirCompressor":
        [
        {"val":"Cummins-Wabco, 18.7 CFM"}
        ],
        "gdVCBatteryBoxMetal":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"STEEL", "val":"Steel", "price":"STD" },
        {"id":"ALUMINUM", "val":"Aluminum", "price":"STD" }
        ],
        "gdVCBatteryCapabilities":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"(3) Three GRP 31, 925 CCA Ea.", "val":"(3) Three GRP 31, 925 CCA Ea.", "price":"STD" },
        {"id":"(4) Four GRP 31, 925 CCA Ea.", "val":"(4) Four GRP 31, 925 CCA Ea.", "price":"STD" }
        ],
        "gdVCStarter":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Delco 39MT - OCP", "val":"Delco 39MT - OCP", "price":"STD" }
        ],
        "gdVCAlternator":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"BOSCH LH160, 160-Amp", "val":"BOSCH LH160, 160-Amp", "price":"STD" },
        {"id":"Delco-Remy 24SI, 160-AMP", "val":"Delco-Remy 24SI, 160-AMP", "price":"STD" },
        {"id":"BOSCH LH200, 200-Amp", "val":"BOSCH LH200, 200-Amp", "price":"STD" },
        {"id":"Leece-Neville 4863JB-200-AMP", "val":"Leece-Neville 4863JB-200-AMP", "price":"STD" }
        ],
        "gdVCFilterSeperator":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Racor 490RP10, Non-Heated", "val":"Racor 490RP10, Non-Heated", "price":"61" },
        {"id":"Racor 490RP10, Heated", "val":"Racor 490RP10, Heated", "price":"61" },
        {"id":"Fleetguard FS1000, Non-Heated", "val":"Fleetguard FS1000, Non-Heated", "price":"84" },
        {"id":"Fleetguard FS1000, Heated", "val":"Fleetguard FS1000, Heated", "price":"31" }
        ],
        "gdVCFuelTank":
        [
        {"id":"", "val":"--", "price":"0" },
        { "id":"Steel Tanks", "val":"Steel Tanks", "price":"31" },
        { "id":"60 Gallon Steel Single Tank", "val":"60 Gallon Steel Single Tank", "price":"631" },
        { "id":"60 Gallon Steel Dual Tanks, 120 Gal. Total", "val":"60 Gallon Steel Dual Tanks, 120 Gal. Total", "price":"651" },
        { "id":"50 Gallon Steel Narrow Single Tank", "val":"50 Gallon Steel Narrow Single Tank", "price":"31" },
        { "id":"80 Gallon Steel Single Tank, Round", "val":"80 Gallon Steel Single Tank, Round", "price":"651" },
        { "id":"80 Gallon Steel Dual Tanks, 160 Gal. Total", "val":"80 Gallon Steel Dual Tanks, 160 Gal. Total", "price":"8" },
        { "id":"Aluminum Tanks", "val":"Aluminum Tanks", "price":"36" },
        { "id":"60 Gallon Alum. Single Tank", "val":"60 Gallon Alum. Single Tank", "price":"914" },
        { "id":"50 Gallon Alum. Dual Tanks, 100 Gal. Total", "val":"50 Gallon Alum. Dual Tanks, 100 Gal. Total", "price":"214" },
        { "id":"80 Gallon Alum. Single Tank, Round", "val":"80 Gallon Alum. Single Tank, Round", "price":"85" },
        { "id":"80 Gallon Alum. Dual Tanks, 160 Gal. Total", "val":"80 Gallon Alum. Dual Tanks, 160 Gal. Total", "price":"51" }
        ],
        "gdVCFuelTankLocation":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Standard Location", "val":"Standard Location", "price":"STD" },
        {"id":"Custom Location", "val":"Custom Location", "price":"225" }
        ],
        "gdVCFuelTankAccess01":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Protectoseal Fill Neck 2 in.", "val":"Protectoseal Fill Neck 2 in.", "price":"51" },
        {"id":"Protectoseal Fill Neck 4 in.", "val":"Protectoseal Fill Neck 4 in.", "price":"516" },
        {"id":"Anti-Siphon Fill Neck 2 in.", "val":"Anti-Siphon Fill Neck 2 in.", "price":"54" },
        {"id":"Anti-Siphon Fill Neck 4 in.", "val":"Anti-Siphon Fill Neck 4 in.", "price":"846" },
        {"id":"Locking Fuel Cap", "val":"Locking Fuel Cap", "price":"56" }
        ],
        "gdVCTransRetarderSpeed":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"3000RDS", "val":"3000RDS", "price":"16195" },
        {"id":"3500RDS", "val":"3500RDS", "price":"16195" }
        ]
    }
    ],
    "CUMMINS - ISC8.3-330" :
    [
    { 
        "gdVCEngineTorque":
        [
        {"val":"1850"}
        ],
        "gdVCEngineRPM":
        [
        {"val":"@ 1900 RPM"}
        ],
        "gdVCAirCompressor":
        [
        {"val":"Cummins-Wabco, 18.7 CFM"}
        ],
        "gdVCBatteryBoxMetal":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"STEEL", "val":"Steel", "price":"STD" },
        {"id":"ALUMINUM", "val":"Aluminum", "price":"STD" }
        ],
        "gdVCBatteryCapabilities":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"(3) Three GRP 31, 925 CCA Ea.", "val":"(3) Three GRP 31, 925 CCA Ea.", "price":"STD" },
        {"id":"(4) Four GRP 31, 925 CCA Ea.", "val":"(4) Four GRP 31, 925 CCA Ea.", "price":"STD" }
        ],
        "gdVCStarter":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Delco 39MT - OCP", "val":"Delco 39MT - OCP", "price":"STD" }
        ],
        "gdVCAlternator":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"BOSCH LH160, 160-Amp", "val":"BOSCH LH160, 160-Amp", "price":"STD" },
        {"id":"Delco-Remy 24SI, 160-AMP", "val":"Delco-Remy 24SI, 160-AMP", "price":"STD" },
        {"id":"BOSCH LH200, 200-Amp", "val":"BOSCH LH200, 200-Amp", "price":"STD" },
        {"id":"Leece-Neville 4863JB-200-AMP", "val":"Leece-Neville 4863JB-200-AMP", "price":"STD" }
        ],
        "gdVCFilterSeperator":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Racor 490RP10, Non-Heated", "val":"Racor 490RP10, Non-Heated", "price":"3234" },
        {"id":"Racor 490RP10, Heated", "val":"Racor 490RP10, Heated", "price":"519" },
        {"id":"Fleetguard FS1000, Non-Heated", "val":"Fleetguard FS1000, Non-Heated", "price":"35" },
        {"id":"Fleetguard FS1000, Heated", "val":"Fleetguard FS1000, Heated", "price":"5" }
        ],
        "gdVCFuelTank":
        [
        {"id":"", "val":"--", "price":"0" },
        { "id":"Steel Tanks", "val":"Steel Tanks", "price":"31" },
        { "id":"60 Gallon Steel Single Tank", "val":"60 Gallon Steel Single Tank", "price":"534" },
        { "id":"60 Gallon Steel Dual Tanks, 120 Gal. Total", "val":"60 Gallon Steel Dual Tanks, 120 Gal. Total", "price":"605" },
        { "id":"50 Gallon Steel Narrow Single Tank", "val":"50 Gallon Steel Narrow Single Tank", "price":"34" },
        { "id":"80 Gallon Steel Single Tank, Round", "val":"80 Gallon Steel Single Tank, Round", "price":"65" },
        { "id":"80 Gallon Steel Dual Tanks, 160 Gal. Total", "val":"80 Gallon Steel Dual Tanks, 160 Gal. Total", "price":"314" },
        { "id":"Aluminum Tanks", "val":"Aluminum Tanks", "price":"61" },
        { "id":"60 Gallon Alum. Single Tank", "val":"60 Gallon Alum. Single Tank", "price":"4" },
        { "id":"50 Gallon Alum. Dual Tanks, 100 Gal. Total", "val":"50 Gallon Alum. Dual Tanks, 100 Gal. Total", "price":"5" },
        { "id":"80 Gallon Alum. Single Tank, Round", "val":"80 Gallon Alum. Single Tank, Round", "price":"67" },
        { "id":"80 Gallon Alum. Dual Tanks, 160 Gal. Total", "val":"80 Gallon Alum. Dual Tanks, 160 Gal. Total", "price":"6" }
        ],
        "gdVCFuelTankLocation":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Standard Location", "val":"Standard Location", "price":"STD" },
        {"id":"Custom Location", "val":"Custom Location", "price":"225" }
        ],
        "gdVCFuelTankAccess01":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Protectoseal Fill Neck 2 in.", "val":"Protectoseal Fill Neck 2 in.", "price":"35" },
        {"id":"Protectoseal Fill Neck 4 in.", "val":"Protectoseal Fill Neck 4 in.", "price":"16" },
        {"id":"Anti-Siphon Fill Neck 2 in.", "val":"Anti-Siphon Fill Neck 2 in.", "price":"345" },
        {"id":"Anti-Siphon Fill Neck 4 in.", "val":"Anti-Siphon Fill Neck 4 in.", "price":"1" },
        {"id":"Locking Fuel Cap", "val":"Locking Fuel Cap", "price":"354" }
        ],
        "gdVCTransRetarderSpeed":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"3000RDS", "val":"3000RDS", "price":"16195" },
        {"id":"3500RDS", "val":"3500RDS", "price":"16195" }
        ]
    }
    ],
    "CUMMINS - ISC8.3-350" :
    [
    { 
        "gdVCEngineTorque":
        [
        {"val":"1150"}
        ],
        "gdVCEngineRPM":
        [
        {"val":"@ 1200 RPM"}
        ],
        "gdVCAirCompressor":
        [
        {"val":"Cummins-Wabco, 18.7 CFM"}
        ],
        "gdVCBatteryBoxMetal":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"STEEL", "val":"Steel", "price":"STD" },
        {"id":"ALUMINUM", "val":"Aluminum", "price":"STD" }
        ],
        "gdVCBatteryCapabilities":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"(3) Three GRP 31, 925 CCA Ea.", "val":"(3) Three GRP 31, 925 CCA Ea.", "price":"STD" },
        {"id":"(4) Four GRP 31, 925 CCA Ea.", "val":"(4) Four GRP 31, 925 CCA Ea.", "price":"STD" }
        ],
        "gdVCStarter":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Delco 39MT - OCP", "val":"Delco 39MT - OCP", "price":"STD" }
        ],
        "gdVCAlternator":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"BOSCH LH160, 160-Amp", "val":"BOSCH LH160, 160-Amp", "price":"STD" },
        {"id":"Delco-Remy 24SI, 160-AMP", "val":"Delco-Remy 24SI, 160-AMP", "price":"STD" },
        {"id":"BOSCH LH200, 200-Amp", "val":"BOSCH LH200, 200-Amp", "price":"STD" },
        {"id":"Leece-Neville 4863JB-200-AMP", "val":"Leece-Neville 4863JB-200-AMP", "price":"STD" }
        ],
        "gdVCFilterSeperator":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Racor 490RP10, Non-Heated", "val":"Racor 490RP10, Non-Heated", "price":"16" },
        {"id":"Racor 490RP10, Heated", "val":"Racor 490RP10, Heated", "price":"89" },
        {"id":"Fleetguard FS1000, Non-Heated", "val":"Fleetguard FS1000, Non-Heated", "price":"321" },
        {"id":"Fleetguard FS1000, Heated", "val":"Fleetguard FS1000, Heated", "price":"57" }
        ],
        "gdVCFuelTank":
        [
        {"id":"", "val":"--", "price":"0" },
        { "id":"Steel Tanks", "val":"Steel Tanks", "price":"168" },
        { "id":"60 Gallon Steel Single Tank", "val":"60 Gallon Steel Single Tank", "price":"43" },
        { "id":"60 Gallon Steel Dual Tanks, 120 Gal. Total", "val":"60 Gallon Steel Dual Tanks, 120 Gal. Total", "price":"61" },
        { "id":"50 Gallon Steel Narrow Single Tank", "val":"50 Gallon Steel Narrow Single Tank", "price":"7" },
        { "id":"80 Gallon Steel Single Tank, Round", "val":"80 Gallon Steel Single Tank, Round", "price":"6" },
        { "id":"80 Gallon Steel Dual Tanks, 160 Gal. Total", "val":"80 Gallon Steel Dual Tanks, 160 Gal. Total", "price":"345" },
        { "id":"Aluminum Tanks", "val":"Aluminum Tanks", "price":"61" },
        { "id":"60 Gallon Alum. Single Tank", "val":"60 Gallon Alum. Single Tank", "price":"3" },
        { "id":"50 Gallon Alum. Dual Tanks, 100 Gal. Total", "val":"50 Gallon Alum. Dual Tanks, 100 Gal. Total", "price":"61" },
        { "id":"80 Gallon Alum. Single Tank, Round", "val":"80 Gallon Alum. Single Tank, Round", "price":"345" },
        { "id":"80 Gallon Alum. Dual Tanks, 160 Gal. Total", "val":"80 Gallon Alum. Dual Tanks, 160 Gal. Total", "price":"3" }
        ],
        "gdVCFuelTankLocation":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Standard Location", "val":"Standard Location", "price":"STD" },
        {"id":"Custom Location", "val":"Custom Location", "price":"225" }
        ],
        "gdVCFuelTankAccess01":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Protectoseal Fill Neck 2 in.", "val":"Protectoseal Fill Neck 2 in.", "price":"34" },
        {"id":"Protectoseal Fill Neck 4 in.", "val":"Protectoseal Fill Neck 4 in.", "price":"31" },
        {"id":"Anti-Siphon Fill Neck 2 in.", "val":"Anti-Siphon Fill Neck 2 in.", "price":"34" },
        {"id":"Anti-Siphon Fill Neck 4 in.", "val":"Anti-Siphon Fill Neck 4 in.", "price":"16" },
        {"id":"Locking Fuel Cap", "val":"Locking Fuel Cap", "price":"13" }
        ],
        "gdVCTransRetarderSpeed":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"3000RDS", "val":"3000RDS", "price":"16195" },
        {"id":"3500RDS", "val":"3500RDS", "price":"16195" }
        ]
    }
    ],
    "CUMMINS - ISL9-345" :
    [
    { 
        "gdVCEngineTorque":
        [
        {"val":"1150"}
        ],
        "gdVCEngineRPM":
        [
        {"val":"@ 1200 RPM"}
        ],
        "gdVCAirCompressor":
        [
        {"val":"Cummins-Wabco, 18.7 CFM"}
        ],
        "gdVCBatteryBoxMetal":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"STEEL", "val":"Steel", "price":"STD" },
        {"id":"ALUMINUM", "val":"Aluminum", "price":"STD" }
        ],
        "gdVCBatteryCapabilities":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"(3) Three GRP 31, 925 CCA Ea.", "val":"(3) Three GRP 31, 925 CCA Ea.", "price":"STD" },
        {"id":"(4) Four GRP 31, 925 CCA Ea.", "val":"(4) Four GRP 31, 925 CCA Ea.", "price":"STD" }
        ],
        "gdVCStarter":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Delco 39MT - OCP", "val":"Delco 39MT - OCP", "price":"STD" }
        ],
        "gdVCAlternator":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"BOSCH LH160, 160-Amp", "val":"BOSCH LH160, 160-Amp", "price":"STD" },
        {"id":"Delco-Remy 24SI, 160-AMP", "val":"Delco-Remy 24SI, 160-AMP", "price":"STD" },
        {"id":"BOSCH LH200, 200-Amp", "val":"BOSCH LH200, 200-Amp", "price":"STD" },
        {"id":"Leece-Neville 4863JB-200-AMP", "val":"Leece-Neville 4863JB-200-AMP", "price":"STD" }
        ],
        "gdVCFilterSeperator":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Racor 490RP10, Non-Heated", "val":"Racor 490RP10, Non-Heated", "price":"35" },
        {"id":"Racor 490RP10, Heated", "val":"Racor 490RP10, Heated", "price":"84" },
        {"id":"Fleetguard FS1000, Non-Heated", "val":"Fleetguard FS1000, Non-Heated", "price":"64" },
        {"id":"Fleetguard FS1000, Heated", "val":"Fleetguard FS1000, Heated", "price":"61" }
        ],
        "gdVCFuelTank":
        [
        {"id":"", "val":"--", "price":"0" },
        { "id":"Steel Tanks", "val":"Steel Tanks", "price":"61" },
        { "id":"60 Gallon Steel Single Tank", "val":"60 Gallon Steel Single Tank", "price":"35" },
        { "id":"60 Gallon Steel Dual Tanks, 120 Gal. Total", "val":"60 Gallon Steel Dual Tanks, 120 Gal. Total", "price":"31" },
        { "id":"50 Gallon Steel Narrow Single Tank", "val":"50 Gallon Steel Narrow Single Tank", "price":"61" },
        { "id":"80 Gallon Steel Single Tank, Round", "val":"80 Gallon Steel Single Tank, Round", "price":"31" },
        { "id":"80 Gallon Steel Dual Tanks, 160 Gal. Total", "val":"80 Gallon Steel Dual Tanks, 160 Gal. Total", "price":"61" },
        { "id":"Aluminum Tanks", "val":"Aluminum Tanks", "price":"61" },
        { "id":"60 Gallon Alum. Single Tank", "val":"60 Gallon Alum. Single Tank", "price":"54" },
        { "id":"50 Gallon Alum. Dual Tanks, 100 Gal. Total", "val":"50 Gallon Alum. Dual Tanks, 100 Gal. Total", "price":"354" },
        { "id":"80 Gallon Alum. Single Tank, Round", "val":"80 Gallon Alum. Single Tank, Round", "price":"61" },
        { "id":"80 Gallon Alum. Dual Tanks, 160 Gal. Total", "val":"80 Gallon Alum. Dual Tanks, 160 Gal. Total", "price":"64" }
        ],
        "gdVCFuelTankLocation":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Standard Location", "val":"Standard Location", "price":"STD" },
        {"id":"Custom Location", "val":"Custom Location", "price":"225" }
        ],
        "gdVCFuelTankAccess01":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Protectoseal Fill Neck 2 in.", "val":"Protectoseal Fill Neck 2 in.", "price":"4" },
        {"id":"Protectoseal Fill Neck 4 in.", "val":"Protectoseal Fill Neck 4 in.", "price":"61" },
        {"id":"Anti-Siphon Fill Neck 2 in.", "val":"Anti-Siphon Fill Neck 2 in.", "price":"347" },
        {"id":"Anti-Siphon Fill Neck 4 in.", "val":"Anti-Siphon Fill Neck 4 in.", "price":"61" },
        {"id":"Locking Fuel Cap", "val":"Locking Fuel Cap", "price":"354" }
        ],
        "gdVCTransRetarderSpeed":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"3000RDS", "val":"3000RDS", "price":"16195" },
        {"id":"3500RDS", "val":"3500RDS", "price":"16195" }
        ]
    }
    ],
    "CUMMINS - ISL9-370" :
    [
    { 
        "gdVCEngineTorque":
        [
        {"val":"1150"}
        ],
        "gdVCEngineRPM":
        [
        {"val":"@ 1200 RPM"}
        ],
        "gdVCAirCompressor":
        [
        {"val":"Cummins-Wabco, 18.7 CFM"}
        ],
        "gdVCBatteryBoxMetal":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"STEEL", "val":"Steel", "price":"STD" },
        {"id":"ALUMINUM", "val":"Aluminum", "price":"STD" }
        ],
        "gdVCBatteryCapabilities":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"", "val":"--", "price":"0" },
        {"id":"(3) Three GRP 31, 925 CCA Ea.", "val":"(3) Three GRP 31, 925 CCA Ea.", "price":"STD" },
        {"id":"(4) Four GRP 31, 925 CCA Ea.", "val":"(4) Four GRP 31, 925 CCA Ea.", "price":"STD" }
        ],
        "gdVCStarter":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Delco 39MT - OCP", "val":"Delco 39MT - OCP", "price":"STD" }
        ],
        "gdVCAlternator":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"BOSCH LH160, 160-Amp", "val":"BOSCH LH160, 160-Amp", "price":"STD" },
        {"id":"Delco-Remy 24SI, 160-AMP", "val":"Delco-Remy 24SI, 160-AMP", "price":"STD" },
        {"id":"BOSCH LH200, 200-Amp", "val":"BOSCH LH200, 200-Amp", "price":"STD" },
        {"id":"Leece-Neville 4863JB-200-AMP", "val":"Leece-Neville 4863JB-200-AMP", "price":"STD" }
        ],
        "gdVCFilterSeperator":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Racor 490RP10, Non-Heated", "val":"Racor 490RP10, Non-Heated", "price":"661" },
        {"id":"Racor 490RP10, Heated", "val":"Racor 490RP10, Heated", "price":"345" },
        {"id":"Fleetguard FS1000, Non-Heated", "val":"Fleetguard FS1000, Non-Heated", "price":"61" },
        {"id":"Fleetguard FS1000, Heated", "val":"Fleetguard FS1000, Heated", "price":"34" }
        ],
        "gdVCFuelTank":
        [
        {"id":"", "val":"--", "price":"0" },
        { "id":"Steel Tanks", "val":"Steel Tanks", "price":"61" },
        { "id":"60 Gallon Steel Single Tank", "val":"60 Gallon Steel Single Tank", "price":"354" },
        { "id":"60 Gallon Steel Dual Tanks, 120 Gal. Total", "val":"60 Gallon Steel Dual Tanks, 120 Gal. Total", "price":"61" },
        { "id":"50 Gallon Steel Narrow Single Tank", "val":"50 Gallon Steel Narrow Single Tank", "price":"34" },
        { "id":"80 Gallon Steel Single Tank, Round", "val":"80 Gallon Steel Single Tank, Round", "price":"61" },
        { "id":"80 Gallon Steel Dual Tanks, 160 Gal. Total", "val":"80 Gallon Steel Dual Tanks, 160 Gal. Total", "price":"354" },
        { "id":"Aluminum Tanks", "val":"Aluminum Tanks", "price":"61" },
        { "id":"60 Gallon Alum. Single Tank", "val":"60 Gallon Alum. Single Tank", "price":"345" },
        { "id":"50 Gallon Alum. Dual Tanks, 100 Gal. Total", "val":"50 Gallon Alum. Dual Tanks, 100 Gal. Total", "price":"61" },
        { "id":"80 Gallon Alum. Single Tank, Round", "val":"80 Gallon Alum. Single Tank, Round", "price":"34" },
        { "id":"80 Gallon Alum. Dual Tanks, 160 Gal. Total", "val":"80 Gallon Alum. Dual Tanks, 160 Gal. Total", "price":"61" }
        ],
        "gdVCFuelTankLocation":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Standard Location", "val":"Standard Location", "price":"STD" },
        {"id":"Custom Location", "val":"Custom Location", "price":"225" }
        ],
        "gdVCFuelTankAccess01":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Protectoseal Fill Neck 2 in.", "val":"Protectoseal Fill Neck 2 in.", "price":"654" },
        {"id":"Protectoseal Fill Neck 4 in.", "val":"Protectoseal Fill Neck 4 in.", "price":"61" },
        {"id":"Anti-Siphon Fill Neck 2 in.", "val":"Anti-Siphon Fill Neck 2 in.", "price":"354" },
        {"id":"Anti-Siphon Fill Neck 4 in.", "val":"Anti-Siphon Fill Neck 4 in.", "price":"61" },
        {"id":"Locking Fuel Cap", "val":"Locking Fuel Cap", "price":"341" }
        ],
        "gdVCTransRetarderSpeed":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"3000RDS", "val":"3000RDS", "price":"16195" },
        {"id":"3500RDS", "val":"3500RDS", "price":"16195" }
        ]
    }
    ],
    "CUMMINS - ISL9-380" :
    [
    { 
        "gdVCEngineTorque":
        [
        {"val":"1150"}
        ],
        "gdVCEngineRPM":
        [
        {"val":"@ 1200 RPM"}
        ],
        "gdVCAirCompressor":
        [
        {"val":"Cummins-Wabco, 18.7 CFM"}
        ],
        "gdVCBatteryBoxMetal":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"STEEL", "val":"Steel", "price":"STD" },
        {"id":"ALUMINUM", "val":"Aluminum", "price":"STD" }
        ],
        "gdVCBatteryCapabilities":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"(3) Three GRP 31, 925 CCA Ea.", "val":"(3) Three GRP 31, 925 CCA Ea.", "price":"STD" },
        {"id":"(4) Four GRP 31, 925 CCA Ea.", "val":"(4) Four GRP 31, 925 CCA Ea.", "price":"STD" }
        ],
        "gdVCStarter":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Delco 39MT - OCP", "val":"Delco 39MT - OCP", "price":"STD" }
        ],
        "gdVCAlternator":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"BOSCH LH160, 160-Amp", "val":"BOSCH LH160, 160-Amp", "price":"STD" },
        {"id":"Delco-Remy 24SI, 160-AMP", "val":"Delco-Remy 24SI, 160-AMP", "price":"STD" },
        {"id":"BOSCH LH200, 200-Amp", "val":"BOSCH LH200, 200-Amp", "price":"STD" },
        {"id":"Leece-Neville 4863JB-200-AMP", "val":"Leece-Neville 4863JB-200-AMP", "price":"STD" }
        ],
        "gdVCFilterSeperator":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Racor 490RP10, Non-Heated", "val":"Racor 490RP10, Non-Heated", "price":"61" },
        {"id":"Racor 490RP10, Heated", "val":"Racor 490RP10, Heated", "price":"61" },
        {"id":"Fleetguard FS1000, Non-Heated", "val":"Fleetguard FS1000, Non-Heated", "price":"34" },
        {"id":"Fleetguard FS1000, Heated", "val":"Fleetguard FS1000, Heated", "price":"61" }
        ],
        "gdVCFuelTank":
        [
        {"id":"", "val":"--", "price":"0" },
        { "id":"Steel Tanks", "val":"Steel Tanks", "price":"34" },
        { "id":"60 Gallon Steel Single Tank", "val":"60 Gallon Steel Single Tank", "price":"61" },
        { "id":"60 Gallon Steel Dual Tanks, 120 Gal. Total", "val":"60 Gallon Steel Dual Tanks, 120 Gal. Total", "price":"354" },
        { "id":"50 Gallon Steel Narrow Single Tank", "val":"50 Gallon Steel Narrow Single Tank", "price":"61" },
        { "id":"80 Gallon Steel Single Tank, Round", "val":"80 Gallon Steel Single Tank, Round", "price":"31" },
        { "id":"80 Gallon Steel Dual Tanks, 160 Gal. Total", "val":"80 Gallon Steel Dual Tanks, 160 Gal. Total", "price":"61" },
        { "id":"Aluminum Tanks", "val":"Aluminum Tanks", "price":"43" },
        { "id":"60 Gallon Alum. Single Tank", "val":"60 Gallon Alum. Single Tank", "price":"61" },
        { "id":"50 Gallon Alum. Dual Tanks, 100 Gal. Total", "val":"50 Gallon Alum. Dual Tanks, 100 Gal. Total", "price":"6" },
        { "id":"80 Gallon Alum. Single Tank, Round", "val":"80 Gallon Alum. Single Tank, Round", "price":"31" },
        { "id":"80 Gallon Alum. Dual Tanks, 160 Gal. Total", "val":"80 Gallon Alum. Dual Tanks, 160 Gal. Total", "price":"48" }
        ],
        "gdVCFuelTankLocation":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Standard Location", "val":"Standard Location", "price":"STD" },
        {"id":"Custom Location", "val":"Custom Location", "price":"225" }
        ],
        "gdVCFuelTankAccess01":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Protectoseal Fill Neck 2 in.", "val":"Protectoseal Fill Neck 2 in.", "price":"61" },
        {"id":"Protectoseal Fill Neck 4 in.", "val":"Protectoseal Fill Neck 4 in.", "price":"31" },
        {"id":"Anti-Siphon Fill Neck 2 in.", "val":"Anti-Siphon Fill Neck 2 in.", "price":"16" },
        {"id":"Anti-Siphon Fill Neck 4 in.", "val":"Anti-Siphon Fill Neck 4 in.", "price":"46" },
        {"id":"Locking Fuel Cap", "val":"Locking Fuel Cap", "price":"31" }
        ],
        "gdVCTransRetarderSpeed":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"3000RDS", "val":"3000RDS", "price":"16195" },
        {"id":"3500RDS", "val":"3500RDS", "price":"16195" }
        ]
    }
    ],
    "CUMMINS - ISX11.9-320" :
    [
    { 
        "gdVCEngineTorque":
        [
        {"val":"1150"}
        ],
        "gdVCEngineRPM":
        [
        {"val":"@ 1200 RPM"}
        ],
        "gdVCAirCompressor":
        [
        {"val":"Cummins-Wabco, 18.7 CFM"}
        ],
        "gdVCBatteryBoxMetal":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"STEEL", "val":"Steel", "price":"STD" },
        {"id":"ALUMINUM", "val":"Aluminum", "price":"STD" }
        ],
        "gdVCBatteryCapabilities":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"(3) Three GRP 31, 925 CCA Ea.", "val":"(3) Three GRP 31, 925 CCA Ea.", "price":"STD" },
        {"id":"(4) Four GRP 31, 925 CCA Ea.", "val":"(4) Four GRP 31, 925 CCA Ea.", "price":"STD" }
        ],
        "gdVCStarter":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Delco 39MT - OCP", "val":"Delco 39MT - OCP", "price":"STD" }
        ],
        "gdVCAlternator":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"BOSCH LH160, 160-Amp", "val":"BOSCH LH160, 160-Amp", "price":"STD" },
        {"id":"Delco-Remy 24SI, 160-AMP", "val":"Delco-Remy 24SI, 160-AMP", "price":"STD" },
        {"id":"BOSCH LH200, 200-Amp", "val":"BOSCH LH200, 200-Amp", "price":"STD" },
        {"id":"Leece-Neville 4863JB-200-AMP", "val":"Leece-Neville 4863JB-200-AMP", "price":"STD" }
        ],
        "gdVCFilterSeperator":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Racor 490RP10, Non-Heated", "val":"Racor 490RP10, Non-Heated", "price":"61" },
        {"id":"Racor 490RP10, Heated", "val":"Racor 490RP10, Heated", "price":"345" },
        {"id":"Fleetguard FS1000, Non-Heated", "val":"Fleetguard FS1000, Non-Heated", "price":"6" },
        {"id":"Fleetguard FS1000, Heated", "val":"Fleetguard FS1000, Heated", "price":"614" }
        ],
        "gdVCFuelTank":
        [
        {"id":"", "val":"--", "price":"0" },
        { "id":"Steel Tanks", "val":"Steel Tanks", "price":"61" },
        { "id":"60 Gallon Steel Single Tank", "val":"60 Gallon Steel Single Tank", "price":"61" },
        { "id":"60 Gallon Steel Dual Tanks, 120 Gal. Total", "val":"60 Gallon Steel Dual Tanks, 120 Gal. Total", "price":"43" },
        { "id":"50 Gallon Steel Narrow Single Tank", "val":"50 Gallon Steel Narrow Single Tank", "price":"61" },
        { "id":"80 Gallon Steel Single Tank, Round", "val":"80 Gallon Steel Single Tank, Round", "price":"31" },
        { "id":"80 Gallon Steel Dual Tanks, 160 Gal. Total", "val":"80 Gallon Steel Dual Tanks, 160 Gal. Total", "price":"61" },
        { "id":"Aluminum Tanks", "val":"Aluminum Tanks", "price":"6" },
        { "id":"60 Gallon Alum. Single Tank", "val":"60 Gallon Alum. Single Tank", "price":"984" },
        { "id":"50 Gallon Alum. Dual Tanks, 100 Gal. Total", "val":"50 Gallon Alum. Dual Tanks, 100 Gal. Total", "price":"61" },
        { "id":"80 Gallon Alum. Single Tank, Round", "val":"80 Gallon Alum. Single Tank, Round", "price":"31" },
        { "id":"80 Gallon Alum. Dual Tanks, 160 Gal. Total", "val":"80 Gallon Alum. Dual Tanks, 160 Gal. Total", "price":"61" }
        ],
        "gdVCFuelTankLocation":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Standard Location", "val":"Standard Location", "price":"STD" },
        {"id":"Custom Location", "val":"Custom Location", "price":"225" }
        ],
        "gdVCFuelTankAccess01":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Protectoseal Fill Neck 2 in.", "val":"Protectoseal Fill Neck 2 in.", "price":"345" },
        {"id":"Protectoseal Fill Neck 4 in.", "val":"Protectoseal Fill Neck 4 in.", "price":"61" },
        {"id":"Anti-Siphon Fill Neck 2 in.", "val":"Anti-Siphon Fill Neck 2 in.", "price":"345" },
        {"id":"Anti-Siphon Fill Neck 4 in.", "val":"Anti-Siphon Fill Neck 4 in.", "price":"61" },
        {"id":"Locking Fuel Cap", "val":"Locking Fuel Cap", "price":"631" }
        ],
        "gdVCTransRetarderSpeed":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"3000RDS", "val":"3000RDS", "price":"16195" },
        {"id":"3500RDS", "val":"3500RDS", "price":"16195" }
        ]
    }
    ],
    "CUMMINS - ISX11.9-350" :
    [
    { 
        "gdVCEngineTorque":
        [
        {"val":"1150"}
        ],
        "gdVCEngineRPM":
        [
        {"val":"@ 1200 RPM"}
        ],
        "gdVCAirCompressor":
        [
        {"val":"Cummins-Wabco, 18.7 CFM"}
        ],
        "gdVCBatteryBoxMetal":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"STEEL", "val":"Steel", "price":"STD" },
        {"id":"ALUMINUM", "val":"Aluminum", "price":"STD" }
        ],
        "gdVCBatteryCapabilities":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"(3) Three GRP 31, 925 CCA Ea.", "val":"(3) Three GRP 31, 925 CCA Ea.", "price":"STD" },
        {"id":"(4) Four GRP 31, 925 CCA Ea.", "val":"(4) Four GRP 31, 925 CCA Ea.", "price":"STD" }
        ],
        "gdVCStarter":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Delco 39MT - OCP", "val":"Delco 39MT - OCP", "price":"STD" }
        ],
        "gdVCAlternator":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"BOSCH LH160, 160-Amp", "val":"BOSCH LH160, 160-Amp", "price":"STD" },
        {"id":"Delco-Remy 24SI, 160-AMP", "val":"Delco-Remy 24SI, 160-AMP", "price":"STD" },
        {"id":"BOSCH LH200, 200-Amp", "val":"BOSCH LH200, 200-Amp", "price":"STD" },
        {"id":"Leece-Neville 4863JB-200-AMP", "val":"Leece-Neville 4863JB-200-AMP", "price":"STD" }
        ],
        "gdVCFilterSeperator":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Racor 490RP10, Non-Heated", "val":"Racor 490RP10, Non-Heated", "price":"61" },
        {"id":"Racor 490RP10, Heated", "val":"Racor 490RP10, Heated", "price":"61" },
        {"id":"Fleetguard FS1000, Non-Heated", "val":"Fleetguard FS1000, Non-Heated", "price":"61" },
        {"id":"Fleetguard FS1000, Heated", "val":"Fleetguard FS1000, Heated", "price":"1" }
        ],
        "gdVCFuelTank":
        [
        {"id":"", "val":"--", "price":"0" },
        { "id":"Steel Tanks", "val":"Steel Tanks", "price":"61" },
        { "id":"60 Gallon Steel Single Tank", "val":"60 Gallon Steel Single Tank", "price":"661" },
        { "id":"60 Gallon Steel Dual Tanks, 120 Gal. Total", "val":"60 Gallon Steel Dual Tanks, 120 Gal. Total", "price":"61" },
        { "id":"50 Gallon Steel Narrow Single Tank", "val":"50 Gallon Steel Narrow Single Tank", "price":"61" },
        { "id":"80 Gallon Steel Single Tank, Round", "val":"80 Gallon Steel Single Tank, Round", "price":"61" },
        { "id":"80 Gallon Steel Dual Tanks, 160 Gal. Total", "val":"80 Gallon Steel Dual Tanks, 160 Gal. Total", "price":"61" },
        { "id":"Aluminum Tanks", "val":"Aluminum Tanks", "price":"435" },
        { "id":"60 Gallon Alum. Single Tank", "val":"60 Gallon Alum. Single Tank", "price":"1" },
        { "id":"50 Gallon Alum. Dual Tanks, 100 Gal. Total", "val":"50 Gallon Alum. Dual Tanks, 100 Gal. Total", "price":"035" },
        { "id":"80 Gallon Alum. Single Tank, Round", "val":"80 Gallon Alum. Single Tank, Round", "price":"530" },
        { "id":"80 Gallon Alum. Dual Tanks, 160 Gal. Total", "val":"80 Gallon Alum. Dual Tanks, 160 Gal. Total", "price":"53" }
        ],
        "gdVCFuelTankLocation":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Standard Location", "val":"Standard Location", "price":"STD" },
        {"id":"Custom Location", "val":"Custom Location", "price":"225" }
        ],
        "gdVCFuelTankAccess01":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Protectoseal Fill Neck 2 in.", "val":"Protectoseal Fill Neck 2 in.", "price":"16" },
        {"id":"Protectoseal Fill Neck 4 in.", "val":"Protectoseal Fill Neck 4 in.", "price":"61" },
        {"id":"Anti-Siphon Fill Neck 2 in.", "val":"Anti-Siphon Fill Neck 2 in.", "price":"54" },
        {"id":"Anti-Siphon Fill Neck 4 in.", "val":"Anti-Siphon Fill Neck 4 in.", "price":"61" },
        {"id":"Locking Fuel Cap", "val":"Locking Fuel Cap", "price":"61" }
        ],
        "gdVCTransRetarderSpeed":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"3000RDS", "val":"3000RDS", "price":"16195" },
        {"id":"3500RDS", "val":"3500RDS", "price":"16195" }
        ]
    }
    ],
    "CUMMINS - ISX11.9-385" :
    [
    { 
        "gdVCEngineTorque":
        [
        {"val":"1150"}
        ],
        "gdVCEngineRPM":
        [
        {"val":"@ 1200 RPM"}
        ],
        "gdVCAirCompressor":
        [
        {"val":"Cummins-Wabco, 18.7 CFM"}
        ],
        "gdVCBatteryBoxMetal":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"STEEL", "val":"Steel", "price":"STD" },
        {"id":"ALUMINUM", "val":"Aluminum", "price":"STD" }
        ],
        "gdVCBatteryCapabilities":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"(3) Three GRP 31, 925 CCA Ea.", "val":"(3) Three GRP 31, 925 CCA Ea.", "price":"STD" },
        {"id":"(4) Four GRP 31, 925 CCA Ea.", "val":"(4) Four GRP 31, 925 CCA Ea.", "price":"STD" }
        ],
        "gdVCStarter":
        [
        {"id":"Delco 39MT - OCP", "val":"Delco 39MT - OCP", "price":"STD" }
        ],
        "gdVCAlternator":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"BOSCH LH160, 160-Amp", "val":"BOSCH LH160, 160-Amp", "price":"STD" },
        {"id":"Delco-Remy 24SI, 160-AMP", "val":"Delco-Remy 24SI, 160-AMP", "price":"STD" },
        {"id":"BOSCH LH200, 200-Amp", "val":"BOSCH LH200, 200-Amp", "price":"STD" },
        {"id":"Leece-Neville 4863JB-200-AMP", "val":"Leece-Neville 4863JB-200-AMP", "price":"STD" }
        ],
        "gdVCFilterSeperator":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Racor 490RP10, Non-Heated", "val":"Racor 490RP10, Non-Heated", "price":"61" },
        {"id":"Racor 490RP10, Heated", "val":"Racor 490RP10, Heated", "price":"345" },
        {"id":"Fleetguard FS1000, Non-Heated", "val":"Fleetguard FS1000, Non-Heated", "price":"123" },
        {"id":"Fleetguard FS1000, Heated", "val":"Fleetguard FS1000, Heated", "price":"354" }
        ],
        "gdVCFuelTank":
        [
        {"id":"", "val":"--", "price":"0" },
        { "id":"Steel Tanks", "val":"Steel Tanks", "price":"65" },
        { "id":"60 Gallon Steel Single Tank", "val":"60 Gallon Steel Single Tank", "price":"15" },
        { "id":"60 Gallon Steel Dual Tanks, 120 Gal. Total", "val":"60 Gallon Steel Dual Tanks, 120 Gal. Total", "price":"615" },
        { "id":"50 Gallon Steel Narrow Single Tank", "val":"50 Gallon Steel Narrow Single Tank", "price":"546" },
        { "id":"80 Gallon Steel Single Tank, Round", "val":"80 Gallon Steel Single Tank, Round", "price":"35" },
        { "id":"80 Gallon Steel Dual Tanks, 160 Gal. Total", "val":"80 Gallon Steel Dual Tanks, 160 Gal. Total", "price":"8" },
        { "id":"Aluminum Tanks", "val":"Aluminum Tanks", "price":"984" },
        { "id":"60 Gallon Alum. Single Tank", "val":"60 Gallon Alum. Single Tank", "price":"81" },
        { "id":"50 Gallon Alum. Dual Tanks, 100 Gal. Total", "val":"50 Gallon Alum. Dual Tanks, 100 Gal. Total", "price":"1" },
        { "id":"80 Gallon Alum. Single Tank, Round", "val":"80 Gallon Alum. Single Tank, Round", "price":"869" },
        { "id":"80 Gallon Alum. Dual Tanks, 160 Gal. Total", "val":"80 Gallon Alum. Dual Tanks, 160 Gal. Total", "price":"16" }
        ],
        "gdVCFuelTankLocation":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Standard Location", "val":"Standard Location", "price":"STD" },
        {"id":"Custom Location", "val":"Custom Location", "price":"225" }
        ],
        "gdVCFuelTankAccess01":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Protectoseal Fill Neck 2 in.", "val":"Protectoseal Fill Neck 2 in.", "price":"6" },
        {"id":"Protectoseal Fill Neck 4 in.", "val":"Protectoseal Fill Neck 4 in.", "price":"651" },
        {"id":"Anti-Siphon Fill Neck 2 in.", "val":"Anti-Siphon Fill Neck 2 in.", "price":"61" },
        {"id":"Anti-Siphon Fill Neck 4 in.", "val":"Anti-Siphon Fill Neck 4 in.", "price":"61" },
        {"id":"Locking Fuel Cap", "val":"Locking Fuel Cap", "price":"61" }
        ],
        "gdVCTransRetarderSpeed":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"3000RDS", "val":"3000RDS", "price":"16195" },
        {"id":"3500RDS", "val":"3500RDS", "price":"16195" }
        ]
    }
    ],
    "CUMMINS - ISLG-250" :
    [
    { 
        "gdVCEngineTorque":
        [
        {"val":"1150"}
        ],
        "gdVCEngineRPM":
        [
        {"val":"@ 1200 RPM"}
        ],
        "gdVCAirCompressor":
        [
        {"val":"Cummins-Wabco, 18.7 CFM"}
        ],
        "gdVCBatteryBoxMetal":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"STEEL", "val":"Steel", "price":"STD" },
        {"id":"ALUMINUM", "val":"Aluminum", "price":"STD" }
        ],
        "gdVCBatteryCapabilities":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"(3) Three GRP 31, 925 CCA Ea.", "val":"(3) Three GRP 31, 925 CCA Ea.", "price":"STD" },
        {"id":"(4) Four GRP 31, 925 CCA Ea.", "val":"(4) Four GRP 31, 925 CCA Ea.", "price":"STD" }
        ],
        "gdVCStarter":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Delco 39MT - OCP", "val":"Delco 39MT - OCP", "price":"STD" }
        ],
        "gdVCAlternator":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"BOSCH LH160, 160-Amp", "val":"BOSCH LH160, 160-Amp", "price":"STD" },
        {"id":"Delco-Remy 24SI, 160-AMP", "val":"Delco-Remy 24SI, 160-AMP", "price":"STD" },
        {"id":"BOSCH LH200, 200-Amp", "val":"BOSCH LH200, 200-Amp", "price":"STD" },
        {"id":"Leece-Neville 4863JB-200-AMP", "val":"Leece-Neville 4863JB-200-AMP", "price":"STD" }
        ],
        "gdVCFilterSeperator":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Racor 490RP10, Non-Heated", "val":"Racor 490RP10, Non-Heated", "price":"61" },
        {"id":"Racor 490RP10, Heated", "val":"Racor 490RP10, Heated", "price":"984" },
        {"id":"Fleetguard FS1000, Non-Heated", "val":"Fleetguard FS1000, Non-Heated", "price":"984" },
        {"id":"Fleetguard FS1000, Heated", "val":"Fleetguard FS1000, Heated", "price":"984" }
        ],
        "gdVCFuelTank":
        [
        {"id":"", "val":"--", "price":"0" },
        { "id":"Steel Tanks", "val":"Steel Tanks", "price":"61" },
        { "id":"60 Gallon Steel Single Tank", "val":"60 Gallon Steel Single Tank", "price":"31" },
        { "id":"60 Gallon Steel Dual Tanks, 120 Gal. Total", "val":"60 Gallon Steel Dual Tanks, 120 Gal. Total", "price":"5" },
        { "id":"50 Gallon Steel Narrow Single Tank", "val":"50 Gallon Steel Narrow Single Tank", "price":"9" },
        { "id":"80 Gallon Steel Single Tank, Round", "val":"80 Gallon Steel Single Tank, Round", "price":"4" },
        { "id":"80 Gallon Steel Dual Tanks, 160 Gal. Total", "val":"80 Gallon Steel Dual Tanks, 160 Gal. Total", "price":"631" },
        { "id":"Aluminum Tanks", "val":"Aluminum Tanks", "price":"61" },
        { "id":"60 Gallon Alum. Single Tank", "val":"60 Gallon Alum. Single Tank", "price":"61" },
        { "id":"50 Gallon Alum. Dual Tanks, 100 Gal. Total", "val":"50 Gallon Alum. Dual Tanks, 100 Gal. Total", "price":"13" },
        { "id":"80 Gallon Alum. Single Tank, Round", "val":"80 Gallon Alum. Single Tank, Round", "price":"4" },
        { "id":"80 Gallon Alum. Dual Tanks, 160 Gal. Total", "val":"80 Gallon Alum. Dual Tanks, 160 Gal. Total", "price":"45" }
        ],
        "gdVCFuelTankLocation":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Standard Location", "val":"Standard Location", "price":"STD" },
        {"id":"Custom Location", "val":"Custom Location", "price":"225" }
        ],
        "gdVCFuelTankAccess01":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Protectoseal Fill Neck 2 in.", "val":"Protectoseal Fill Neck 2 in.", "price":"51" },
        {"id":"Protectoseal Fill Neck 4 in.", "val":"Protectoseal Fill Neck 4 in.", "price":"61" },
        {"id":"Anti-Siphon Fill Neck 2 in.", "val":"Anti-Siphon Fill Neck 2 in.", "price":"651" },
        {"id":"Anti-Siphon Fill Neck 4 in.", "val":"Anti-Siphon Fill Neck 4 in.", "price":"678" },
        {"id":"Locking Fuel Cap", "val":"Locking Fuel Cap", "price":"6" }
        ],
        "gdVCTransRetarderSpeed":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"3000RDS", "val":"3000RDS", "price":"16195" },
        {"id":"3500RDS", "val":"3500RDS", "price":"16195" }
        ]
    }
    ],
    "CUMMINS - ISLG-300" :
    [
    { 
        "gdVCEngineTorque":
        [
        {"val":"2150"}
        ],
        "gdVCEngineRPM":
        [
        {"val":"@ 3575 RPM"}
        ],
        "gdVCAirCompressor":
        [
        {"val":"Cummins-Wabco, 18.7 CFM"}
        ],
        "gdVCBatteryBoxMetal":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"STEEL", "val":"Steel", "price":"STD" },
        {"id":"ALUMINUM", "val":"Aluminum", "price":"STD" }
        ],
        "gdVCBatteryCapabilities":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"(3) Three GRP 31, 925 CCA Ea.", "val":"(3) Three GRP 31, 925 CCA Ea.", "price":"STD" },
        {"id":"(4) Four GRP 31, 925 CCA Ea.", "val":"(4) Four GRP 31, 925 CCA Ea.", "price":"STD" }
        ],
        "gdVCStarter":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Delco 39MT - OCP", "val":"Delco 39MT - OCP", "price":"STD" }
        ],
        "gdVCAlternator":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"BOSCH LH160, 160-Amp", "val":"BOSCH LH160, 160-Amp", "price":"STD" },
        {"id":"Delco-Remy 24SI, 160-AMP", "val":"Delco-Remy 24SI, 160-AMP", "price":"STD" },
        {"id":"BOSCH LH200, 200-Amp", "val":"BOSCH LH200, 200-Amp", "price":"STD" },
        {"id":"Leece-Neville 4863JB-200-AMP", "val":"Leece-Neville 4863JB-200-AMP", "price":"STD" }
        ],
        "gdVCFilterSeperator":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Racor 490RP10, Non-Heated", "val":"Racor 490RP10, Non-Heated", "price":"615" },
        {"id":"Racor 490RP10, Heated", "val":"Racor 490RP10, Heated", "price":"61" },
        {"id":"Fleetguard FS1000, Non-Heated", "val":"Fleetguard FS1000, Non-Heated", "price":"61" },
        {"id":"Fleetguard FS1000, Heated", "val":"Fleetguard FS1000, Heated", "price":"3" }
        ],
        "gdVCFuelTank":
        [
        {"id":"", "val":"--", "price":"0" },
        { "id":"Steel Tanks", "val":"Steel Tanks", "price":"156" },
        { "id":"60 Gallon Steel Single Tank", "val":"60 Gallon Steel Single Tank", "price":"71" },
        { "id":"60 Gallon Steel Dual Tanks, 120 Gal. Total", "val":"60 Gallon Steel Dual Tanks, 120 Gal. Total", "price":"9" },
        { "id":"50 Gallon Steel Narrow Single Tank", "val":"50 Gallon Steel Narrow Single Tank", "price":"19" },
        { "id":"80 Gallon Steel Single Tank, Round", "val":"80 Gallon Steel Single Tank, Round", "price":"91" },
        { "id":"80 Gallon Steel Dual Tanks, 160 Gal. Total", "val":"80 Gallon Steel Dual Tanks, 160 Gal. Total", "price":"984" },
        { "id":"Aluminum Tanks", "val":"Aluminum Tanks", "price":"849" },
        { "id":"60 Gallon Alum. Single Tank", "val":"60 Gallon Alum. Single Tank", "price":"918" },
        { "id":"50 Gallon Alum. Dual Tanks, 100 Gal. Total", "val":"50 Gallon Alum. Dual Tanks, 100 Gal. Total", "price":"918" },
        { "id":"80 Gallon Alum. Single Tank, Round", "val":"80 Gallon Alum. Single Tank, Round", "price":"948" },
        { "id":"80 Gallon Alum. Dual Tanks, 160 Gal. Total", "val":"80 Gallon Alum. Dual Tanks, 160 Gal. Total", "price":"9" }
        ],
        "gdVCFuelTankLocation":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Standard Location", "val":"Standard Location", "price":"STD" },
        {"id":"Custom Location", "val":"Custom Location", "price":"225" }
        ],
        "gdVCFuelTankAccess01":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Protectoseal Fill Neck 2 in.", "val":"Protectoseal Fill Neck 2 in.", "price":"91" },
        {"id":"Protectoseal Fill Neck 4 in.", "val":"Protectoseal Fill Neck 4 in.", "price":"91" },
        {"id":"Anti-Siphon Fill Neck 2 in.", "val":"Anti-Siphon Fill Neck 2 in.", "price":"1" },
        {"id":"Anti-Siphon Fill Neck 4 in.", "val":"Anti-Siphon Fill Neck 4 in.", "price":"64" },
        {"id":"Locking Fuel Cap", "val":"Locking Fuel Cap", "price":"1" }
        ],
        "gdVCTransRetarderSpeed":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"3000RDS", "val":"3000RDS", "price":"16195" },
        {"id":"3500RDS", "val":"3500RDS", "price":"16195" }
        ]
    }
    ],
    "CUMMINS - ISLG-320" :
    [
    { 
        "gdVCEngineTorque":
        [
        {"val":"1550"}
        ],
        "gdVCEngineRPM":
        [
        {"val":"@ 1600 RPM"}
        ],
        "gdVCAirCompressor":
        [
        {"val":"Cummins-Wabco, 18.7 CFM"}
        ],
        "gdVCBatteryBoxMetal":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"STEEL", "val":"Steel", "price":"STD" },
        {"id":"ALUMINUM", "val":"Aluminum", "price":"STD" }
        ],
        "gdVCBatteryCapabilities":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"(3) Three GRP 31, 925 CCA Ea.", "val":"(3) Three GRP 31, 925 CCA Ea.", "price":"STD" },
        {"id":"(4) Four GRP 31, 925 CCA Ea.", "val":"(4) Four GRP 31, 925 CCA Ea.", "price":"STD" }
        ],
        "gdVCStarter":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Delco 39MT - OCP", "val":"Delco 39MT - OCP", "price":"STD" }
        ],
        "gdVCAlternator":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"BOSCH LH160, 160-Amp", "val":"BOSCH LH160, 160-Amp", "price":"STD" },
        {"id":"Delco-Remy 24SI, 160-AMP", "val":"Delco-Remy 24SI, 160-AMP", "price":"STD" },
        {"id":"BOSCH LH200, 200-Amp", "val":"BOSCH LH200, 200-Amp", "price":"STD" },
        {"id":"Leece-Neville 4863JB-200-AMP", "val":"Leece-Neville 4863JB-200-AMP", "price":"STD" }
        ],
        "gdVCFilterSeperator":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Racor 490RP10, Non-Heated", "val":"Racor 490RP10, Non-Heated", "price":"91" },
        {"id":"Racor 490RP10, Heated", "val":"Racor 490RP10, Heated", "price":"9" },
        {"id":"Fleetguard FS1000, Non-Heated", "val":"Fleetguard FS1000, Non-Heated", "price":"98" },
        {"id":"Fleetguard FS1000, Heated", "val":"Fleetguard FS1000, Heated", "price":"91" }
        ],
        "gdVCFuelTank":
        [
        {"id":"", "val":"--", "price":"0" },
        { "id":"Steel Tanks", "val":"Steel Tanks", "price":"965" },
        { "id":"60 Gallon Steel Single Tank", "val":"60 Gallon Steel Single Tank", "price":"1" },
        { "id":"60 Gallon Steel Dual Tanks, 120 Gal. Total", "val":"60 Gallon Steel Dual Tanks, 120 Gal. Total", "price":"91" },
        { "id":"50 Gallon Steel Narrow Single Tank", "val":"50 Gallon Steel Narrow Single Tank", "price":"98" },
        { "id":"80 Gallon Steel Single Tank, Round", "val":"80 Gallon Steel Single Tank, Round", "price":"84" },
        { "id":"80 Gallon Steel Dual Tanks, 160 Gal. Total", "val":"80 Gallon Steel Dual Tanks, 160 Gal. Total", "price":"1" },
        { "id":"Aluminum Tanks", "val":"Aluminum Tanks", "price":"1" },
        { "id":"60 Gallon Alum. Single Tank", "val":"60 Gallon Alum. Single Tank", "price":"1" },
        { "id":"50 Gallon Alum. Dual Tanks, 100 Gal. Total", "val":"50 Gallon Alum. Dual Tanks, 100 Gal. Total", "price":"16" },
        { "id":"80 Gallon Alum. Single Tank, Round", "val":"80 Gallon Alum. Single Tank, Round", "price":"1" },
        { "id":"80 Gallon Alum. Dual Tanks, 160 Gal. Total", "val":"80 Gallon Alum. Dual Tanks, 160 Gal. Total", "price":"51" }
        ],
        "gdVCFuelTankLocation":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Standard Location", "val":"Standard Location", "price":"STD" },
        {"id":"Custom Location", "val":"Custom Location", "price":"225" }
        ],
        "gdVCFuelTankAccess01":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Protectoseal Fill Neck 2 in.", "val":"Protectoseal Fill Neck 2 in.", "price":"81" },
        {"id":"Protectoseal Fill Neck 4 in.", "val":"Protectoseal Fill Neck 4 in.", "price":"51" },
        {"id":"Anti-Siphon Fill Neck 2 in.", "val":"Anti-Siphon Fill Neck 2 in.", "price":"6" },
        {"id":"Anti-Siphon Fill Neck 4 in.", "val":"Anti-Siphon Fill Neck 4 in.", "price":"651" },
        {"id":"Locking Fuel Cap", "val":"Locking Fuel Cap", "price":"1" }
        ],
        "gdVCTransRetarderSpeed":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"3000RDS", "val":"3000RDS", "price":"16195" },
        {"id":"3500RDS", "val":"3500RDS", "price":"16195" }
        ]
    }
    ]
}
<?php } ?>
<?php if(tblkey.equalsIgnoreCase("lh_controls_mirrors"))
{?>
{
    "Solid" :
    [
    { 
        "gdVCCabInteriorWindowsLHControl":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Electric, Roll-Down","val":"Electric, Roll-Down","price":"61" },
        {"id":"Manual, Roll-Down","val":"Manual, Roll-Down","price":"61" }
        ],
        "gdVCCabInteriorMirrorLH":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"16 x 7 S S West Coast w Combo 'A'","val":"16 x 7 S/S West Coast w Combo 'A'","price":"61" },
        {"id":"16 x 7 S S West Coast Htd w Combo 'B'","val":"16' x 7' S S West Coast Htd w Combo 'B'","price":"68" },
        {"id":"19 x 8 Black Split Lens 'C'", "val":"19 x 8 Black Split Lens 'C'", "price":"98" },
        {"id":"19 x 8 Black Split Lens Htd w Signal 'D'", "val":"19 x 8 Black Split Lens Htd w Signal 'D'", "price":"81" },
        {"id":"19 x 8 Black 4-Way Split Lens Htd w Signal 'E'", "val":"19 x 8 Black 4-Way Split Lens Htd w Signal 'E'", "price":"61" }
        ]
    }
    ],
    "Bi-Fold" :
    [
    { 
        "gdVCCabInteriorWindowsLHControl":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Sliding","val":"Sliding","price":"16" },
        {"id":"Additional Sliding","val":"Additional Sliding","price":"61" }
        ],
        "gdVCCabInteriorMirrorLH":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"16 x 7 S S West Coast w Combo 'A'","val":"16 x 7 S/S West Coast w Combo 'A'","price":"16" },
        {"id":"16 x 7 S S West Coast Htd w Combo 'B'","val":"16' x 7' S S West Coast Htd w Combo 'B'","price":"6578" },
        {"id":"19 x 8 Black Split Lens 'C'", "val":"19 x 8 Black Split Lens 'C'", "price":"987" },
        {"id":"19 x 8 Black Split Lens Htd w Signal 'D'", "val":"19 x 8 Black Split Lens Htd w Signal 'D'", "price":"61" },
        {"id":"19 x 8 Black 4-Way Split Lens Htd w Signal 'E'", "val":"19 x 8 Black 4-Way Split Lens Htd w Signal 'E'", "price":"981" }
        ]
    }
    ],
    "Flip-Up - Fold-Back" :
    [
    { 
        "gdVCCabInteriorWindowsLHControl":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Sliding","val":"Sliding","price":"91" },
        {"id":"Additional Sliding","val":"Additional Sliding","price":"91" }
        ],
        "gdVCCabInteriorMirrorLH":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"16 x 7 S S West Coast w Combo 'A'","val":"16 x 7 S/S West Coast w Combo 'A'","price":"981" },
        {"id":"16 x 7 S S West Coast Htd w Combo 'B'","val":"16' x 7' S S West Coast Htd w Combo 'B'","price":"661" },
        {"id":"19 x 8 Black Split Lens 'C'", "val":"19 x 8 Black Split Lens 'C'", "price":"91" },
        {"id":"19 x 8 Black Split Lens Htd w Signal 'D'", "val":"19 x 8 Black Split Lens Htd w Signal 'D'", "price":"321" },
        {"id":"19 x 8 Black 4-Way Split Lens Htd w Signal 'E'", "val":"19 x 8 Black 4-Way Split Lens Htd w Signal 'E'", "price":"987" }
        ]
    }
    ],
    "Flip-Up - Fold-Back n In" :
    [
    { 
        "gdVCCabInteriorWindowsLHControl":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Sliding","val":"Sliding","price":"9814" },
        {"id":"Additional Sliding","val":"Additional Sliding","price":"91" }
        ],
        "gdVCCabInteriorMirrorLH":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"16 x 7 S S West Coast w Combo 'A'","val":"16 x 7 S/S West Coast w Combo 'A'","price":"91" },
        {"id":"16 x 7 S S West Coast Htd w Combo 'B'","val":"16' x 7' S S West Coast Htd w Combo 'B'","price":"91" },
        {"id":"19 x 8 Black Split Lens 'C'", "val":"19 x 8 Black Split Lens 'C'", "price":"91" },
        {"id":"19 x 8 Black Split Lens Htd w Signal 'D'", "val":"19 x 8 Black Split Lens Htd w Signal 'D'", "price":"91" },
        {"id":"19 x 8 Black 4-Way Split Lens Htd w Signal 'E'", "val":"19 x 8 Black 4-Way Split Lens Htd w Signal 'E'", "price":"31" }
        ]
    }
    ]
}
<?php } ?>
<?php if(tblkey.equalsIgnoreCase("rh_controls_mirrors"))
{?>
{
    "Solid" :
    [
    { 
        "gdVCCabInteriorWindowsRHControl":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Electric, Roll-Down","val":"Electric, Roll-Down","price":"61" },
        {"id":"Manual, Roll-Down","val":"Manual, Roll-Down","price":"0" }
        ],
        "gdVCCabInteriorMirrorRH":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"16 x 7 S S West Coast w Combo 'A'","val":"16 x 7 S/S West Coast w Combo 'A'","price":"984" },
        {"id":"16 x 7 S S West Coast Htd w Combo 'B'","val":"16' x 7' S S West Coast Htd w Combo 'B'","price":"61" },
        {"id":"19 x 8 Black Split Lens 'C'", "val":"19 x 8 Black Split Lens 'C'", "price":"661" },
        {"id":"19 x 8 Black Split Lens Htd w Signal 'D'", "val":"19 x 8 Black Split Lens Htd w Signal 'D'", "price":"897" },
        {"id":"19 x 8 Black 4-Way Split Lens Htd w Signal 'E'", "val":"19 x 8 Black 4-Way Split Lens Htd w Signal 'E'", "price":"6" }
        ]
    }
    ],
    "Bi-Fold" :
    [
    { 
        "gdVCCabInteriorWindowsRHControl":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Sliding","val":"Sliding","price":"981" },
        {"id":"Additional Sliding","val":"Additional Sliding","price":"98" }
        ],
        "gdVCCabInteriorMirrorRH":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"16 x 7 S S West Coast w Combo 'A'","val":"16 x 7 S/S West Coast w Combo 'A'","price":"91" },
        {"id":"16 x 7 S S West Coast Htd w Combo 'B'","val":"16' x 7' S S West Coast Htd w Combo 'B'","price":"91" },
        {"id":"19 x 8 Black Split Lens 'C'", "val":"19 x 8 Black Split Lens 'C'", "price":"13" },
        {"id":"19 x 8 Black Split Lens Htd w Signal 'D'", "val":"19 x 8 Black Split Lens Htd w Signal 'D'", "price":"54" },
        {"id":"19 x 8 Black 4-Way Split Lens Htd w Signal 'E'", "val":"19 x 8 Black 4-Way Split Lens Htd w Signal 'E'", "price":"1816" }
        ]
    }
    ],
    "Flip-Up - Fold-Back" :
    [
    { 
        "gdVCCabInteriorWindowsRHControl":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Sliding","val":"Sliding","price":"16" },
        {"id":"Additional Sliding","val":"Additional Sliding","price":"15" }
        ],
        "gdVCCabInteriorMirrorRH":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"16 x 7 S S West Coast w Combo 'A'","val":"16 x 7 S/S West Coast w Combo 'A'","price":"984" },
        {"id":"16 x 7 S S West Coast Htd w Combo 'B'","val":"16' x 7' S S West Coast Htd w Combo 'B'","price":"61" },
        {"id":"19 x 8 Black Split Lens 'C'", "val":"19 x 8 Black Split Lens 'C'", "price":"984" },
        {"id":"19 x 8 Black Split Lens Htd w Signal 'D'", "val":"19 x 8 Black Split Lens Htd w Signal 'D'", "price":"98" },
        {"id":"19 x 8 Black 4-Way Split Lens Htd w Signal 'E'", "val":"19 x 8 Black 4-Way Split Lens Htd w Signal 'E'", "price":"61" }
        ]
    }
    ],
    "Flip-Up - Fold-Back n In" :
    [
    { 
        "gdVCCabInteriorWindowsRHControl":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"Sliding","val":"Sliding","price":"981" },
        {"id":"Additional Sliding","val":"Additional Sliding","price":"654" }
        ],
        "gdVCCabInteriorMirrorRH":
        [
        {"id":"", "val":"--", "price":"0" },
        {"id":"16 x 7 SS West Coast w Combo 'A'","val":"16 x 7 S/S West Coast w Combo 'A'","price":"646" },
        {"id":"16 x 7 S S West Coast Htd w Combo 'B'","val":"16' x 7' S S West Coast Htd w Combo 'B'","price":"11" },
        {"id":"19 x 8 Black Split Lens 'C'", "val":"19 x 8 Black Split Lens 'C'", "price":"651" },
        {"id":"19 x 8 Black Split Lens Htd w Signal 'D'", "val":"19 x 8 Black Split Lens Htd w Signal 'D'", "price":"51" },
        {"id":"19 x 8 Black 4-Way Split Lens Htd w Signal 'E'", "val":"19 x 8 Black 4-Way Split Lens Htd w Signal 'E'", "price":"546" }
        ]
    }
    ]
}
<?php } ?>

