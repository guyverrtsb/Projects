<?php
/*
* File: image.manipulation.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
* 
*/
class ImageManipulation {
    var $filepath;
    var $image;
    var $image_type;
    var $width, $height, $type, $filename, $fileext;
    function setUploadedImage()
    {
        $this->filepath = $_FILES['image']['tmp_name'];
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
        if ($image_type == IMAGETYPE_JPEG) {
            imagejpeg($this -> image, "/tmp/".$newfilename, $compression);
            $this->filepath = "/tmp/".$newfilename;
        } elseif ($image_type == IMAGETYPE_GIF) {

            imagegif($this -> image, "/tmp/".$newfilename);
            $this->filepath = "/tmp/".$newfilename;
        } elseif ($image_type == IMAGETYPE_PNG) {

            imagepng($this -> image, "/tmp/".$newfilename);
            $this->filepath = "/tmp/".$newfilename;
        }
        if ($permissions != null) {
            chmod($filename, $permissions);
        }
        $this -> setNewFileData();
    }

    function output($image_type = IMAGETYPE_PNG) {

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

        $ratio = $height / $this -> getOrigHeight();
        $width = $this -> getOrigWidth() * $ratio;
        $this -> resize($width, $height);
    }

    function resizeToWidth($width) {
        $ratio = $width / $this -> getOrigWidth();
        $height = $this -> getOrigHeight() * $ratio;
        $this -> resize($width, $height);
    }

    function scale($scale) {
        $width = $this -> getOrigWidth() * $scale / 100;
        $height = $this -> getOrigHeight() * $scale / 100;
        $this -> resize($width, $height);
    }

    function resize($width, $height) {
        $new_image = imagecreatetruecolor($width, $height);
        imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getOrigWidth(), $this->getOrigHeight());
        $this->image = $new_image;
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