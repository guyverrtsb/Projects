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
        $msgshowcaught = false;
        $msgcaught = false;
        for ($idx = 0; $idx < func_num_args(); $idx++)
        {
            $name = func_get_arg($idx);
            $idx++;
            $valu = func_get_arg($idx);
            
            $this->setSysReturnitem($name, $valu);
        }
    }
    
    function transferSysReturnAry($object)
    {
        return $this->setSysReturnAry($object->getSysReturnAry());
    }
    
    function setSysReturnAry($array)
    {
        foreach ($array as $key => $value)
        {
            $this->setSysReturnitem($key, $value);
        }
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
    function setSysReturnData($code, $msg, $showmsg = "FALSE")
    {
        $this->setSysReturnitem("RETURN_CODE", $code);
        $this->setSysReturnitem("RETURN_MSG", $msg);
        $this->setSysReturnitem("RETURN_SHOW_MSG", $showmsg);
        zLog()->LogDebug("RETURN_CODE[".$code."]:RETURN_MSG[".$msg."]:RETURN_SHOW_MSG[".$showmsg."]");
    }
    
    function getSysReturnCode()
    {
        return $this->getSysReturnitem("RETURN_CODE");
    }
    
    /**
     * Show the Task Message
     */    
    function getSysReturnShowMsg()
    {
        return $this->getSysReturnitem("RETURN_SHOW_MSG");
    }
    
    /**
     * Show the Task Message
     */    
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
        $this->zSysReturnAry[strtoupper($name)] = $value;
             if($name == "RETURN_CODE")
            zLog()->Log_ReturnItem("[".$name."]    :[".$value."]");
        else if($name == "RETURN_MSG")
            zLog()->Log_ReturnItem("[".$name."]     :[".$value."]");
        else if($name == "RETURN_SHOW_MSG")
            zLog()->Log_ReturnItem("[".$name."]:[".$value."]");
        else
            zLog()->Log_ReturnItem("[".$name."]:[".$value."]");
    }
    
    function getSysReturnitem($name)
    {
        $val = (isset($this->zSysReturnAry[strtoupper($name)])) ? $this->zSysReturnAry[strtoupper($name)] : "NO_VALUE_SET";
        return $val;
    }
}
?>