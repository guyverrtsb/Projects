<?php
require_once("../../gd.trxn.com/_controls/classes/_core.php");
gdreqonce("/_controls/classes/register/document.php");
gdreqonce("/_controls/classes/register/search.php");
gdreqonce("/_controls/classes/find/document.php");

gdlog()->LogInfo("Out side Good Controller Key");
if(isset($_POST["GD_CONTROLLER_KEY"]))
{
    $action = filter_var($_POST["GD_CONTROLLER_KEY"], FILTER_SANITIZE_STRING);
    gdlog()->LogInfo("Good Controller Key:".$action);
    if($action == "REGISTER_DOCUMENT")
    {
        if(validateRegisterArticleForm())
        {
            $zregdoc = new zRegisterDocument();
            $r = $zregdoc->registerDocument($_POST["content"]);
            if($r == "DOCUMENT_IS_REGISTERED")
            {
                $r = $zregdoc->registerDocumentHeadline($_POST["documentpoint0"],
                                                        $_POST["documentpoint1"],
                                                        $_POST["documentpoint2"],
                                                        $_POST["documentpoint3"],
                                                        $_POST["documentpoint4"],
                                                        $_POST["documentheadline"],
                                                        $_POST["documenttype"],
                                                        $zregdoc->getDocumentUID());

                if($r == "DOCUMENT_HEADLINE_IS_REGISTERED")
                {
                    $zregsearch = new zRegisterSearchData();
                    $r = $zregsearch->registerSearchDocument(strip_tags($_POST["content"]),
                                                        $zregdoc->getDocumentUID(),
                                                        $_POST["documenttype"]);
                    if($r == "SEARCH_CONTENT_IS_REGISTERED")
                    {
                        /*
                        $finddoc = new zFindDocument();
                        $r = $finddoc->findDocumentTemplatefromDocumentTypeSdesc($_POST["documenttype"]);
                        if($r == "DOCUMENT_TYPE_FOUND")
                        {
                            $_SESSION["GD_DOCUMENT_UID"] =  $zregdoc->getDocumentUID();
                            header("Location: ".$finddoc->getDocumentTemplate());
                            exit;
                        }
                        else // "SEARCH_CONTENT_IS_NOT_REGISTERED"
                        {
                            echo $r;
                        }
                         */
                        $zfd = new zFindDocument();
                        $r = $zfd->findDocumentfromUid($zregdoc->getDocumentUID());
                        if($r == "DOCUMENT_FOUND")
                        {
                            $r = json_encode($zfd->getDocument());
                            $zfd->gdlog()->LogInfo("JSON_ENCODE:".$r);
                        }
                        echo $r;
                    }
                    else // "SEARCH_CONTENT_IS_NOT_REGISTERED"
                    {
                        echo $r;
                    }
                }
                else // "DOCUMENT_HEADLINE_IS_NOT_REGISTERED"
                {
                    echo $r;
                }
            }
            else // "DOCUMENT_IS_NOT_REGISTERED"
            {
                echo $r;
            }
        }
        else
        {
            $echoret = json_encode(buildReturnArray("RETURN", "FORM_FIELDS_NOT_VALID"
                                                , "RETURN_SHOW_MSG", "FALSE"));
        }
    }
    else if($action == "DISPLAY_DOCUMENT")
    {
        $zfuniv = new zFindUniversity();
        $r = $zfuniv->findAllUniversitiesAccountsandProfiles();
        if($r == "ACCOUNTS_FOUND")
        {
            $r = json_encode($zfuniv->getAllFoundUniversitiesAccountsandProfilesRecords());
            $zfuniv->gdlog()->LogInfo("JSON_ENCODE:".$r);
        }
        echo $r;
    }
    else if($action == "SHOW_HEADLINES") // Headline for Homepage elements
    {
        gdlog()->LogInfo("Find Headlines");
        $zfd = new zFindDocument();
        $r = $zfd->findHeadlines("10");
        if($r == "HEADLINES_FOUND")
        {
            $r = json_encode($zfd->getHeadlines());
            $zfd->gdlog()->LogInfo("JSON_ENCODE:".$r);
        }
        echo $r;
    }
    else
    {
            $echoret = json_encode(buildReturnArray("RETURN", "UNKNOWN_ERROR"
                                                , "RETURN_SHOW_MSG", "TRUE"
                                                , "RETURN_MSG", "Unknown Error"));
    }
}

function validateRegisterArticleForm()
{
    $fv = "T";  // Form is Valid Key T=Valid; anything else is invalid;
    if (!isset($_POST["content"]) || $_POST["content"] == "")
        $fv = "F";
    if (!isset($_POST["documenttype"]) || $_POST["documenttype"] == "")
        $fv = "F";
    if (!isset($_POST["documentheadline"]) || $_POST["documentheadline"] == "")
        $fv = "F";
    if (!isset($_POST["documentpoint0"]) || $_POST["documentpoint0"] == "")
        $fv = "F";
    if (!isset($_POST["documentpoint1"]) || $_POST["documentpoint1"] == "")
        $fv = "F";
    if (!isset($_POST["documentpoint2"]) || $_POST["documentpoint2"] == "")
        $fv = "F";
    if (!isset($_POST["documentpoint3"]) || $_POST["documentpoint3"] == "")
        $fv = "F";
    if (!isset($_POST["documentpoint4"]) || $_POST["documentpoint4"] == "")
        $fv = "F";
    return $fv;
}
?>