<?php
/**
 * Look at possible extending this out
 */
function validateFormforBlanks()
{
    $fv = true;  // Form is Valid Key T=Valid; anything else is invalid;
    $fieldfailed = "NONE";
    /*
    $numargs = func_num_args();
    if ($numargs >= 2) {
        echo "Second argument is: " . func_get_arg (1) . "<br />\n";
    }
     */
    $args = func_get_args();
    foreach ($args as $idx => $name)
    {
        if (!isset($_POST[$name]) || $_POST[$name] == "")
        {
            zLog()->LogIssue("Bad Field :{".$name."}");
            $fieldfailed = "email";
        }
    }
    
    if($fieldfailed == "NONE")
        return true;
    else
        return false;
}

/**
 * Validating AJAX Query String or Post String calls.
 * $retTF = Return to be brought back
 * $ajaxfile = Ajax FIle Name
 * $fieldfailed = Which Field Failed and needs to be mentioned in Logging
 */
function ajaxValidationLogging($retTF, $ajaxfile, $fieldfailed)
{
    zLog()->LogIssue($ajaxfile." :{".$fieldfailed."}");
    return $retTF; 
}
?>