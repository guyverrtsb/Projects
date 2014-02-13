<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php
/*
* File: image.manipulation.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
* 
*/
class ImageResize
    extends zAppBaseObject
{
    var $filepath, $image, $image_type;
    var $width, $height, $type, $filename, $fileext;
    function setFileToUpload($file_object)
    {
        $this->filepath = $file_object['tmp_name'];
        $this->load();
    }
    
    function setExistingFile($filepath)
    {
        $this->filepath = $filepath;
        $this->load();
    }
    
    function load() {

        $image_info = getimagesize($this->filepath);
        $this -> image_type = $image_info[2];
        if ($this -> image_type == IMAGETYPE_JPEG) {
            $this -> image = imagecreatefromjpeg($this->filepath);
        } elseif ($this -> image_type == IMAGETYPE_GIF) {
            $this -> image = imagecreatefromgif($this->filepath);
        } elseif ($this -> image_type == IMAGETYPE_PNG) {
            $this -> image = imagecreatefrompng($this->filepath);
        }
    }

    function save($newfilename, $image_type = IMAGETYPE_PNG, $compression = 75, $permissions = null) {
        $ospathroot = "";
        if($_SESSION['GUYVERDESIGNS_SERVER_ENVIRONMENT'] == "GDY")
            $ospathroot = "/home/content/l/o/r/lordguyver/html";

        if ($image_type == IMAGETYPE_JPEG) {
            imagejpeg($this -> image, $ospathroot."/tmp/".$newfilename, $compression);
            $this->filepath = $ospathroot."/tmp/".$newfilename;
        } elseif ($image_type == IMAGETYPE_GIF) {

            imagegif($this -> image, $ospathroot."/tmp/".$newfilename);
            $this->filepath = $ospathroot."/tmp/".$newfilename;
        } elseif ($image_type == IMAGETYPE_PNG) {

            imagepng($this -> image, $ospathroot."/tmp/".$newfilename);
            $this->filepath = $ospathroot."/tmp/".$newfilename;
        }
        if ($permissions != null) {
            chmod($filename, $permissions);
        }
        $this -> setNewFileData();
    }

    function getOutputFile($image_type = IMAGETYPE_PNG) {

        if ($image_type == IMAGETYPE_JPEG) {
            imagejpeg($this -> image);
        } elseif ($image_type == IMAGETYPE_GIF) {

            imagegif($this -> image);
        } elseif ($image_type == IMAGETYPE_PNG) {

           imagepng($this -> image,NULL,0,NULL);
        }
    }

    function getWidth() {

        return imagesx($this -> image);
    }

    function getHeight() {

        return imagesy($this -> image);
    }

    function resizeToHeight($height) {

        $ratio = $height / $this -> getHeight();
        $width = $this -> getWidth() * $ratio;
        $this -> resize($width, $height);
    }

    function resizeToWidth($width) {
        $ratio = $width / $this -> getWidth();
        $height = $this -> getheight() * $ratio;
        $this -> resize($width, $height);
    }

    function scale($scale) {
        $width = $this -> getWidth() * $scale / 100;
        $height = $this -> getheight() * $scale / 100;
        $this -> resize($width, $height);
    }

    function resize($width, $height) {
        $new_image = imagecreatetruecolor($width, $height);
        imagecopyresampled($new_image, $this -> image, 0, 0, 0, 0, $width, $height, $this -> getWidth(), $this -> getHeight());
        $this -> image = $new_image;
    }
    
    function setNewFileData()
    {
        list($width, $height, $type, $attr)= getimagesize($this->filepath);
        $this->width = $width;
        $this->height = $height;
        /*
         * 1 = GIF, 2 = JPG, 3 = PNG, 4 = SWF, 5 = PSD, 
         * 6 = BMP, 7 = TIFF(orden de bytes intel), 
         * 8 = TIFF(orden de bytes motorola), 9 = JPC, 
         * 10 = JP2, 11 = JPX, 12 = JB2, 13 = SWC, 
         * 14 = IFF, 15 = WBMP, 16 = XBM. 
         */
        if(IMAGETYPE_GIF == $type)
            $this->type = "GIF";
        else if(IMAGETYPE_JPEG == $type)
            $this->type = "JPEG";
        else if(IMAGETYPE_PNG == $type)
            $this->type = "PNG";
        else
            $this->type = $type;
        $p = explode("/", $this->filepath);
        $p = explode(".",$p[count($p)-1]);

        $this->filename = $p[count($p)-2];
        $this->fileext = $p[count($p)-1];
    }
    
    function getFilePath()
    {
        return $this->filepath;
    }
    function getFileName()
    {
        return $this->filename;
    }
    function getFileExt()
    {
        return $this->fileext;
    }
    function getFileType()
    {
        return $this->type;
    }
    function getFileWidth()
    {
        return $this->width;
    }
    function getFileHeight()
    {
        return $this->height;
    }
    function getFileSize()
    {
        return filesize($this->filepath);
    }
}
?>