<?php gdreqonce("/gd.trxn.com/gduploadmimes/_controls/classes/base/mimesbase.php"); ?>
<?php
/*
* File: image.manipulation.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
* 
*/
class zImageResize
    extends zMimesBaseObject
{
    var $origfilepath, $origimage;
    var $origffolder, $origfname;
    var $origwidth, $origheight, $origtype, $origfsize, $origfext;
    var $newimageobj;
    var $width, $height, $type;
    
    function __construct($ffolder, $origfilename, $fname)
    {
        $this->gdlog()->LogInfoStartFUNCTION("__construct()");
        $this->gdlog()->LogInfo("File Path to Mime :".$ffolder.$origfilename);
        $this->origffolder = $ffolder;
        $this->origfname = $origfilename;
        $this->origfilepath = $this->origffolder.$this->origfname;
        
        $this->ffolder = $ffolder;
        $this->fname = $fname;
        $this->fpath = $this->origffolder.$this->fname;
        
        $p = explode("/", $this->origfilepath);
        $p = explode(".",$p[count($p)-1]);
        $this->origfext = $p[count($p)-1];
    }
    
    function loadOriginalFile()
    {
        $this->gdlog()->LogInfoStartFUNCTION("load()");
        gdlog()->LogInfo("File Location to Load from :".$this->origfilepath);
        
        list($this->origwidth, $this->origheight, $type, $attr) = getimagesize($this->origfilepath);
        $this->origfsize = filesize($this->origfilepath);

        if ($type == IMAGETYPE_JPEG)
        {
            $this->origimage = imagecreatefromjpeg($this->origfilepath);
            $this->origtype = "JPEG";
            $this->gdlog()->LogInfo("imagecreatefromjpeg()");
        }
        elseif ($type == IMAGETYPE_GIF)
        {
            $this->origimage = imagecreatefromgif($this->origfilepath);
            $this->origtype = "GIF";
            $this->gdlog()->LogInfo("imagecreatefromgif()");
        }
        elseif ($type == IMAGETYPE_PNG)
        {
            $this->origimage = imagecreatefrompng($this->origfilepath);
            $this->origtype = "PNG";
            $this->gdlog()->LogInfo("imagecreatefrompng()");
        }
    }

    function saveConfiguredFile($image_type = IMAGETYPE_PNG, $compression = 75, $permissions = null)
    {
        gdlog()->LogInfoStartFUNCTION("save()");
        gdlog()->LogInfo("File Location to Save to :".$this->getFilePath());
        
        if ($image_type == IMAGETYPE_JPEG)
        {
            imagejpeg($this->newimageobj, $this->getFilePath(), $compression);
            $this->type = "JPEG";
        }
        elseif ($image_type == IMAGETYPE_GIF)
        {
            imagegif($this->newimageobj, $this->getFilePath());
            $this->type = "GIF";
        }
        elseif ($image_type == IMAGETYPE_PNG)
        {
            imagepng($this->newimageobj, $this->getFilePath());
            $this->type = "PNG";
        }
        
        if ($permissions != null)
        {
            chmod($this->getFilePath(), $permissions);
        }
        
        $this->setImageData();
        $this->setMimeData();
    }

    function getOutputFile($image_type = IMAGETYPE_PNG) {

        if ($image_type == IMAGETYPE_JPEG)
        {
            imagejpeg($this->newimageobj);
        }
        elseif ($image_type == IMAGETYPE_GIF)
        {
            imagegif($this->newimageobj);
        }
        elseif ($image_type == IMAGETYPE_PNG)
        {
           imagepng($this->newimageobj, NULL, 0, NULL);
        }
    }

    function resizeToHeight($height) {

        $ratio = $height / $this->origheight;
        $width = $this->origwidth * $ratio;
        $this->resize($width, $height);
    }

    function resizeToWidth($width) {
        $ratio = $width / $this->origwidth;
        $height = $this->origheight * $ratio;
        $this->resize($width, $height);
    }

    function scale($scale) {
        $width = $this->origwidth * $scale / 100;
        $height = $this->origheight * $scale / 100;
        $this -> resize($width, $height);
    }

    function resize($width, $height) {
        $new_image = imagecreatetruecolor($width, $height);
        imagecopyresampled($new_image, $this->origimage, 0, 0, 0, 0, $width, $height, $this->origwidth, $this->origheight);
        $this->newimageobj = $new_image;
    }
    
    function setImageData()
    {
        list($this->width, $this->height, $type, $attr) = getimagesize($this->getFilePath());
        /*
         * 1 = GIF, 2 = JPG, 3 = PNG, 4 = SWF, 5 = PSD, 
         * 6 = BMP, 7 = TIFF(orden de bytes intel), 
         * 8 = TIFF(orden de bytes motorola), 9 = JPC, 
         * 10 = JP2, 11 = JPX, 12 = JB2, 13 = SWC, 
         * 14 = IFF, 15 = WBMP, 16 = XBM. 
         */
        if(IMAGETYPE_JPEG == $type)
            $this->ftype = "JPEG";
        else if(IMAGETYPE_GIF == $type)
            $this->ftype = "GIF";
        else if(IMAGETYPE_PNG == $type)
            $this->ftype = "PNG";
        else
            $this->ftype = $type;
    }

    function getOrigWidth()
    {
        return $this->origwidth;
    }

    function getOrigHeight()
    {
        return $this->origheight;
    }
    
    function getOrigType()
    {
        return $this->origtype;
    }
    
    function getOrigSize()
    {
        return filesize($this->origfilepath);
    }
    
    function getOrigFileName()
    {
        return $this->origfname;
    }
    
    function getOrigFilePath()
    {
        return $this->origfilepath;
    }
    
    function getOrigFileExt()
    {
        return $this->origfext;
    }
    
    function getOrigFileFolder()
    {
        return $this->origffolder;
    }

    function getWidth()
    {
        return $this->width;
    }

    function getHeight()
    {
        return $this->height;
    }
    
    function getType()
    {
        return $this->type;
    }
    
    function logImageData()
    {
        $this->gdlog()->LogInfo("Original Width{".$this->getOrigWidth()."}");
        $this->gdlog()->LogInfo("Original Height{".$this->getOrigHeight()."}");
        $this->gdlog()->LogInfo("Original Type{".$this->getOrigType()."}");
        $this->gdlog()->LogInfo("Original Size{".$this->getOrigSize()."}");
        $this->gdlog()->LogInfo("Width{".$this->getWidth()."}");
        $this->gdlog()->LogInfo("Height{".$this->getHeight()."}");
        $this->gdlog()->LogInfo("Type{".$this->getType()."}");
    }
}
?>