<?php
class Designer
{
    private $framework = "BOOTSTRAP";
    private $meta = array();
    function __construct($type)
    {
        $this->framework = strtoupper($type);
    }
    
    function header()
    {
        
    }
    
    function setMeta()
    {
        
    }
}
?>