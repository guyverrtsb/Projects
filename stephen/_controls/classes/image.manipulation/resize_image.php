<?php
/* 
------------------------------------------------------------------------------------
Credits: Bit Repository

Source URL: http://www.bitrepository.com/web-programming/php/resizing-an-image.html
------------------------------------------------------------------------------------
*/
class Resize_Image {

var $image_to_resize;
var $image_id;
var $new_width;
var $new_height;
var $ratio;
var $new_image_name;
var $save_folder;

function resize()
{
    if(!file_exists($this->image_to_resize))
    {
      exit("File ".$this->image_to_resize." does not exist.");
    }
    
    $info = GetImageSize($this->image_to_resize);
    
    if(empty($info))
    {
      exit("The file ".$this->image_to_resize." doesn't seem to be an image.");	
    }
    
    $width = $info[0];
    $height = $info[1];
    $mime = $info['mime'];
    
    /* Keep Aspect Ratio? */
    
    if($this->ratio)
    {
    $thumb = ($this->new_width < $width && $this->new_height < $height) ? true : false; // Thumbnail
    $bigger_image = ($this->new_width > $width || $this->new_height > $height) ? true : false; // Bigger Image
    
    	if($thumb)
    	{
    	    if($this->new_width >= $this->new_height)
    		{
    		$x = ($width / $this->new_width);
    
    		$this->new_height = ($height / $x);
    		}
    		else if($this->new_height >= $this->new_width)
    		{
    		$x = ($height / $this->new_height);
    
    		$this->new_width = ($width / $x);
    		}
    	}
    	else if($bigger_image)
    	{
    	    if($this->new_width >= $width)
    		{
            $x = ($this->new_width / $width);
    
    		$this->new_height = ($height * $x);
    		}
    		else if($this->new_height >= $height)
    		{
    		$x = ($this->new_height / $height);
    
    		$this->new_width = ($width * $x);
    		}
    	}
    }
    
    // What sort of image?
    
    $type = substr(strrchr($mime, '/'), 1);
    
    switch ($type) 
    {
    case 'jpeg':
        $image_create_func = 'ImageCreateFromJPEG';
        $image_save_func = 'ImageJPEG';
    	$new_image_ext = 'jpg';
        break;
    
    case 'png':
        $image_create_func = 'ImageCreateFromPNG';
        $image_save_func = 'ImagePNG';
    	$new_image_ext = 'png';
        break;
    
    case 'bmp':
        $image_create_func = 'ImageCreateFromBMP';
        $image_save_func = 'ImageBMP';
    	$new_image_ext = 'bmp';
        break;
    
    case 'gif':
        $image_create_func = 'ImageCreateFromGIF';
        $image_save_func = 'ImageGIF';
    	$new_image_ext = 'gif';
        break;
    
    case 'vnd.wap.wbmp':
        $image_create_func = 'ImageCreateFromWBMP';
        $image_save_func = 'ImageWBMP';
    	$new_image_ext = 'bmp';
        break;
    
    case 'xbm':
        $image_create_func = 'ImageCreateFromXBM';
        $image_save_func = 'ImageXBM';
    	$new_image_ext = 'xbm';
        break;
    
    default: 
    	$image_create_func = 'ImageCreateFromJPEG';
        $image_save_func = 'ImageJPEG';
    	$new_image_ext = 'jpg';
    }
    
    	// New Image
    	$image_c = ImageCreateTrueColor($this->new_width, $this->new_height);
    
    	$new_image = $image_create_func($this->image_to_resize);
    
    	ImageCopyResampled($image_c, $new_image, 0, 0, 0, 0, $this->new_width, $this->new_height, $width, $height);
    	mysql_query("INSERT INTO site_images VALUES ('', '', '', '$image_c', '$new_image')");
    }

}
?>