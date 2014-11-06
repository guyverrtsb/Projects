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
    var $file;
    
    function __construct($file)
    {
        $this->gdlog()->LogInfoStartFUNCTION("__construct()");
        $this->file = $file;
        $this->gdlog()->LogInfo("File Path to Original Mime :".$this->file->gdOSPath);
    }
    
    function loadFile()
    {
        $this->gdlog()->LogInfoStartFUNCTION("loadFile()");
        list($width, $height, $type, $attr) = getimagesize($this->file->gdOSPath);
        if ($type == IMAGETYPE_JPEG)
        {
            $this->origimage = imagecreatefromjpeg($this->file->gdOSPath);
            $this->origtype = "JPEG";
            $this->gdlog()->LogInfo("imagecreatefromjpeg()");
        }
        elseif ($type == IMAGETYPE_GIF)
        {
            $this->origimage = imagecreatefromgif($this->file->gdOSPath);
            $this->origtype = "GIF";
            $this->gdlog()->LogInfo("imagecreatefromgif()");
        }
        elseif ($type == IMAGETYPE_PNG)
        {
            $this->origimage = imagecreatefrompng($this->file->gdOSPath);
            $this->origtype = "PNG";
            $this->gdlog()->LogInfo("imagecreatefrompng()");
        }
        $this->gdlog()->LogInfoEndFUNCTION("loadFile()");
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
}
?>