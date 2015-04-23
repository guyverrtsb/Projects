<?php zReqOnce("/gd.trxn.com/_controls/classes/_sys/_utilities.php"); ?>
<?php
class SysReturns
    extends SysUtilities
{
    private $zSysReturnAry = array();
    /*
     * Arg [1] = "RETURN"
     * Arg [2] = VALUE
     * Arg [3] ODD = Name of structure
     * Arg [4] EVEN = is value of Structure
     */
    function setSysReturnStructure()
    {
        zLog()->LogInfoStartFUNCTION("setSysReturnStructure");
        $msgshowcaught = false;
        $msgcaught = false;
        for ($idx = 0; $idx < func_num_args(); $idx++)
        {
            $name = func_get_arg($idx);
            $idx++;
            $valu = func_get_arg($idx);
            
            $this->setSysReturnitem($name, $valu);
            
            if(strtoupper($name) == "RETURN_SHOW_MSG")
                $msgshowcaught = true;
            if(strtoupper($name) == "RETURN_MSG")
                $msgcaught = true;
        }
        if(!$msgshowcaught)
            $this->setSysReturnShowMsg("TRUE");    
        if(!$msgcaught)
            $this->setSysReturnMsg("No message defined.");    
        zLog()->LogInfoEndFUNCTION("setSysReturnStructure");
    }
    
    function transferSysReturnAry($object)
    {
        return $this->setSysReturnAry($object->getSysReturnAry());
    }
    
    function setSysReturnAry($array)
    {
        zLog()->LogInfoStartFUNCTION("setSysReturnAry");
        foreach ($array as $key => $value)
        {
            $this->setSysReturnitem($key, $value);
        }
        zLog()->LogInfoEndFUNCTION("setSysReturnAry");
    }
    
    function getSysReturnAry()
    {
        return $this->zSysReturnAry;
    }
    
    function getSysReturnAryJSON()
    {
        return json_encode($this->getSysReturnAry());
    }
    
    /**
     * This is the Code for the return
     * for example "TRANSACTION_FAILURE" 
     */
    function setSysReturnCode($value)
    {
        $this->setSysReturnitem("RETURN_CODE", $value);
    }
    
    function getSysReturnCode()
    {
        return $this->getSysReturnitem("RETURN_CODE");
    }
    
    /**
     * Show the Task Message
     */
    function setSysReturnShowMsg($value)
    {
        $this->setSysReturnitem("RETURN_SHOW_MSG", $value);
    }
    
    function getSysReturnShowMsg()
    {
        return $this->getSysReturnitem("RETURN_SHOW_MSG");
    }
    
    /**
     * Show the Task Message
     */
    function setSysReturnMsg($value)
    {
        $this->setSysReturnitem("RETURN_MSG", $value);
    }
    
    function getSysReturnMsg()
    {
        return $this->getSysReturnitem("RETURN_MSG");
    }
    

    
    /**
     * Name Value item pair  Use this to pass extra
     * data through return structure 
     */
    function setSysReturnitem($name, $value)
    {
        zLog()->LogDebug("setSysReturnitem:{".strtoupper($name)."}:{".$value."}");
        $this->zSysReturnAry[strtoupper($name)] = $value;
    }
    
    function getSysReturnitem($name)
    {
        $val = (isset($this->zSysReturnAry[strtoupper($name)])) ? $this->zSysReturnAry[strtoupper($name)] : "NO_VALUE_SET";
        zLog()->LogDebug("getSysReturnitem:{".strtoupper($name)."}:{".$val."}");
        return $val;
    }
}
?>