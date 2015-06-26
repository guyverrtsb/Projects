{
    "PRODUCT_ATTRIB" :
    [
<?php
$host = "localhost"; $user = "root"; $pass = "GDHonkey01"; $db = "playstephendb";
$dberrono = 0; $dberromsg = 0;

$mysqli = new mysqli($host, $user, $pass, $db); 
if($mysqli->errno)
{
    $dberrono = $mysqli->errno;
    $dberromsg = $mysqli->error;
?>
Error <?= $dberrono ?> Message is <?= $dberromsg ?>
<?php
    exit();
}

// Create Query
$query = "select attribute1, attribute2, attribute3 from prodattributes";

// Execute Query
$result = $mysqli->query($query, MYSQLI_USE_RESULT); 

$c = 0;
while (list($attribute1, $attribute2, $attribute3) = $result->fetch_row())
{
    if($c > 0)
        echo ",";
    echo "{";
    echo "\"id\":\"".$c."\","; 
    echo "\"attr1\":\"".$attribute1."\",";
    echo "\"attr2\":\"".$attribute2."\",";
    echo "\"attr3\":\"".$attribute3."\"";
    echo "}";
    $c++;
}
?>
    ]
}