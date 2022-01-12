<?php 
class pic_upload 
{
    var $picture_edit = FALSE;
    var $pic_width = 640;
    var $pic_height = 480;
	
    var $thumb_picture = FALSE;
    var $thumb_pic_dir = '';
    var $thumb_pic_extension = '_thumb';
    var $thumb_pic_width = 100;
    var $thumb_pic_height = 100;
	
    var $_prefix = '';
    var $suffix_ = '';
	
    var $pic_size_type = 'MB';
    var $picture_size = '10';
    var $size_type_file = 'MB';
    var $size_files = '1';

    var $files = array();
    var $error = NULL;
    var $upload_dir = NULL;
    var $uploaded = false;
    var $uploaded_files = array();
    var $new_file_name = NULL;
    var $info = NULL;
	var $picture_names = NULL;

	function picture_names($names) 
	{
		$this->picture_names = $names;
    }  
	
	function upload_dir($upload_dir) 
	{       
        if (!is_dir($upload_dir)) 
		{
            $this->error .= $upload_dir.' хавтас олдсонгүй.</li>';
        }
       
        if (is_dir($upload_dir) && !is_writable($upload_dir)) 
		{
            $this->error .= $upload_dir.' хавтас бичих эрх байхгүй байна.</li>';
        }
                
        $this->upload_dir = $upload_dir;
    }

    function files($files) 
	{
    	if ($files['name']) 
		{
        	$this->files['tmp_name'][] = $files['tmp_name'];
            $this->files['name'][] = $files['name'];
            $this->files['type'][] = $files['type'];
            $this->files['size'][] = $files['size'];
        }
    }
	
    function is_file_extension($mime_types) 
	{
        //for ($i = 0; $i <= count($this->files['tmp_name']); $i++) 
		{   
            if (!in_array($this->file_extension($this->files['name'][0]), $mime_types))
            {    //echo "tür hata ".$this->files['type'][$i];
                $this->error .= $this->files['name'][0].' файлын өргөтгөл нь тохиромжгүй байна.';
        	}
		}
    }
	  
    function size_find() 
	{
        if (!$this->error) 
		{
            $mime_types_picture = array('image/pjpeg', 'image/jpeg', 'image/gif', 'image/png', 'image/x-png');
            
           // for ($i = 0; $i < count($this->files['tmp_name']); $i++) 
			{
                if (in_array($this->files['type'][0], $mime_types_picture)) 
				{
                    $file_size_pic = $this->all2kbytes($this->picture_size, $this->pic_size_type);
                    $this->size_compare($this->files['size'][0], $file_size_pic, $this->files['name'][0]);
                }else 
				{
                    $file_size = $this->all2kbytes($this->size_files, $this->size_type_file);
                    $this->size_compare($this->files['size'][0], $file_size, $this->files['name'][0]);
                }
            }
        }
    }
    
	function all2kbytes($value, $file_size_type) 
	{
		switch ($file_size_type) 
		{
			case 'B':
				$values = round(($value), 2);
				break;
			case 'KB':
				$values = round(($value * 1024), 2);
				break;
			case 'MB':
				$values = round(($value * 1024 * 1024), 2);
				break;
			case 'GB':
				$values = round(($value * 1024 * 1024 * 1024), 2);
				break;
		}

		return $values;
	}

	function file_extension($file_name) 
	{
        $file_extension = strtolower(substr(strrchr($file_name, '.'), 1));
        return $file_extension;
    }

    function size_compare($size, $file_size, $file) 
	{
        if ($size > $file_size) 
		{
            $this->error .= $file.' файлын хэмжээ том байна. '.$file_size.' -ээс бага байх ёстой. ';

        }
    }
    
	function upload() 
	{
        if (!$this->error) 
		{
            //for ($i = 0; $i < count($this->files['tmp_name']); $i++) 
			{
                $this->new_file_name = $this->file_name_control($this->files['name'][0]);
	
                move_uploaded_file($this->files['tmp_name'][0], $this->upload_dir.'/'.$this->new_file_name);
							
                if ($this->picture_edit) 
				{ 
                    if ($this->file_extension($this->files['name'][0]) == 'jpg' || $this->file_extension($this->files['name'][$i]) == 'jpeg')
					{
                        $this->image_edit_jpe_g($this->upload_dir.'/'.$this->new_file_name);
                    }elseif ($this->file_extension($this->files['name'][0]) == 'gif')
                    {
					    $this->image_edit_gif($this->upload_dir.'/'.$this->new_file_name);
                    }elseif ($this->file_extension($this->files['name'][0]) == 'png')
                    {
					    $this->image_edit_png($this->upload_dir.'/'.$this->new_file_name);
                	}
                	
				}
                if ($this->thumb_picture) 
				{

                    if ($this->file_extension($this->files['name'][0]) == 'jpg' || $this->file_extension($this->files['name'][0]) == 'jpeg')
                    {
					    $this->image_edit_thumb_jpe_g($this->upload_dir.'/'.$this->new_file_name);
                    }elseif ($this->file_extension($this->files['name'][0]) == 'gif')
                    {
					    $this->image_edit_thumb_gif($this->upload_dir.'/'.$this->new_file_name);
                    }elseif ($this->file_extension($this->files['name'][0]) == 'png')
                    {
					    $this->image_edit_thumb_png($this->upload_dir.'/'.$this->new_file_name);
                	}
				}
				$this->uploaded_files[] = $this->new_file_name;
                //$this->info .= $this->files['name'][0].' файлыг '.$this->new_file_name.' нэртэйгээр серверт хуулав. <br />';
            }
            return $this->uploaded = true;
        }
    }

 	function file_name_control($file_name) 
	{
		$file_name = $this->bad_character_rewrite($file_name);
		
		$unique_name = $file_name;
		$unique_name = $this->prefixsuffix($unique_name, $this->_prefix, $this->suffix_); 
		
		return $unique_name;
	}
	   
	function bad_character_rewrite($text) 
	{
		$first = array("\\", "/", ":", ";", "~", "|", "(", ")", "\"", "#", "*", "$", "@", "%", "[", "]", "{", "}", "<", ">", "`", "'", ",", " ", "&#287;", "&#286;", "ü", "Ü", "&#351;", "&#350;", "&#305;", "&#304;", "ö", "Ö", "ç", "Ç");
		$last = array("_", "_", "_", "_", "_", "_", "", "_", "_", "_", "_", "_", "_", "_", "_", "_", "_", "_", "_", "_", "_", "", "_", "_", "g", "G", "u", "U", "s", "S", "i", "I", "o", "O", "c", "C");
		$text_rewrite = str_replace($first, $last, $text);
		return $text_rewrite;
	}

	function prefixsuffix($file_name, $prefix, $suffix) 
	{
		$file_info = pathinfo($file_name);
		$file_name = $file_info['filename'];
		$ext = '.'.$file_info['extension'];
		return $result = $prefix.$this->picture_names.$suffix.$ext;
	}


    function image_edit_jpe_g($source_target) 
	{
        $width_ = $this->pic_width;
        $height_ = $this->pic_height;
        list($width_org, $height_org) = getimagesize($source_target);
		$ratio_org = $width_org/$height_org;
		if ($width_/$height_ > $ratio_org) {
		   $width_ = $height_*$ratio_org;
		} else {
		   $height_ = $width_/$ratio_org;
		}
		
        if ($width_org >= $width_ || $height_org >= $height_) 
		{
            $picture = imagecreatetruecolor($width_, $height_);
            $source = imagecreatefromjpeg($source_target);
            imagecopyresampled($picture, $source, 0, 0, 0, 0, $width_, $height_, $width_org, $height_org);
            imagejpeg($picture, $source_target);
        }
    }
    
    function image_edit_gif($source_target) 
	{
        $width_ = $this->pic_width;
        $height_ = $this->pic_height;
        list($width_org, $height_org) = getimagesize($source_target);
		$ratio_org = $width_org/$height_org;
		if ($width_/$height_ > $ratio_org) {
		   $width_ = $height_*$ratio_org;
		} else {
		   $height_ = $width_/$ratio_org;
		}
				
        if ($width_org >= $width_ || $height_org >= $height_) 
		{
            $picture = imagecreatetruecolor($width_, $height_);
            $source = imagecreatefromgif($source_target);
            imagecopyresampled($picture, $source, 0, 0, 0, 0, $width_, $height_, $width_org, $height_org);
            imagegif($picture, $source_target);
        }
    }
    
    function image_edit_png($source_target) 
	{
        $width_ = $this->pic_width;
        $height_ = $this->pic_height;
        list($width_org, $height_org) = getimagesize($source_target);
		$ratio_org = $width_org/$height_org;
		if ($width_/$height_ > $ratio_org) {
		   $width_ = $height_*$ratio_org;
		} else {
		   $height_ = $width_/$ratio_org;
		}
				
        if ($width_org >= $width_ || $height_org >= $height_) 
		{
            $picture = imagecreatetruecolor($width_, $height_);
            $source = imagecreatefrompng($source_target);
            imagecopyresampled($picture, $source, 0, 0, 0, 0, $width_, $height_, $width_org, $height_org);
            imagepng($picture, $source_target);
        }
    }
    
    function image_edit_thumb_jpe_g($source_target) 
	{
        $width_ = $this->thumb_pic_width;
        $height_ = $this->thumb_pic_height;
        list($width_org, $height_org) = getimagesize($source_target);
		$ratio_org = $width_org/$height_org;
		
		if ($width_/$height_ > $ratio_org) {
		   $width_ = $height_*$ratio_org;
		} else {
		   $height_ = $width_/$ratio_org;
		}

     	if ($width_org > $width_ || $height_org >  $height_) 
		{
			$suffix_name = $this->prefixsuffix($source_target, "", $this->thumb_pic_extension);
			$thumb = imagecreatetruecolor($width_, $height_);
			$source2 = imagecreatefromjpeg($source_target);
			imagecopyresampled($thumb, $source2, 0, 0, 0, 0, $width_, $height_, $width_org, $height_org);
			imagepng($thumb, $this->thumb_pic_dir.'/'.$suffix_name);
			$this->uploaded_files[] = $suffix_name;
//	   	}else 
//		{
//			$suffix_name = $this->prefixsuffix($source_target, "", $this->thumb_pic_extension);
	//		copy($this->upload_dir.'/'.$this->new_file_name, $this->thumb_pic_dir.'/'.$suffix_name);
		}
	}
    
    function image_edit_thumb_gif($source_target)
	{
        $width_ = $this->thumb_pic_width;
        $height_ = $this->thumb_pic_height;
        list($width_org, $height_org) = getimagesize($source_target);
		$ratio_org = $width_org/$height_org;
		
		if ($width_/$height_ > $ratio_org) {
		   $width_ = $height_*$ratio_org;
		} else {
		   $height_ = $width_/$ratio_org;
		}

     	if ($width_org > $width_ || $height_org >  $height_) 
		{
			$suffix_name = $this->prefixsuffix($source_target, "", $this->thumb_pic_extension);
			$thumb = imagecreatetruecolor($width_, $height_);
			$source2 = imagecreatefromgif($source_target);
			imagecopyresampled($thumb, $source2, 0, 0, 0, 0, $width_, $height_, $width_org, $height_org);
			imagepng($thumb, $this->thumb_pic_dir.'/'.$suffix_name);
			$this->uploaded_files[] = $suffix_name;
//	   	}else 
//		{
//			$suffix_name = $this->prefixsuffix($source_target, "", $this->thumb_pic_extension);
//			copy($this->upload_dir.'/'.$this->new_file_name, $this->thumb_pic_dir.'/'.$suffix_name);
		}
	}
    
    function image_edit_thumb_png($source_target) 
	{
        $width_ = $this->thumb_pic_width;
        $height_ = $this->thumb_pic_height;
        list($width_org, $height_org) = getimagesize($source_target);
		$ratio_org = $width_org/$height_org;
		
		if ($width_/$height_ > $ratio_org) {
		   $width_ = $height_*$ratio_org;
		} else {
		   $height_ = $width_/$ratio_org;
		}

     	if ($width_org > $width_ || $height_org >  $height_) 
		{
			$suffix_name = $this->prefixsuffix($source_target, "", $this->thumb_pic_extension);
			$thumb = imagecreatetruecolor($width_, $height_);
			$source2 = imagecreatefrompng($source_target);
			imagecopyresampled($thumb, $source2, 0, 0, 0, 0, $width_, $height_, $width_org, $height_org);
			imagepng($thumb, $this->thumb_pic_dir.'/'.$suffix_name);
			$this->uploaded_files[] = $suffix_name;
//	   	}else 
//		{
	//		$suffix_name = $this->prefixsuffix($source_target, "", $this->thumb_pic_extension);
	//		copy($this->upload_dir.'/'.$this->new_file_name, $this->thumb_pic_dir.'/'.$suffix_name);
		}
	}

    function image_control() 
	{
        $mime_types_picture = array('image/pjpeg', 'image/jpeg', 'image/gif', 'image/png', 'image/x-png');
        
        //for ($i = 0; $i < count($this->files['tmp_name']); $i++) 
		{
            if (in_array($this->files['type'][0], $mime_types_picture)) 
			{
			    if (extension_loaded('gd') && !imagecreatefromstring(file_get_contents($this->files['tmp_name'][0])))
            	{    
                    $this->error .= $this->files['name'][0].' зургийн файл биш байна.';
                }elseif (!getimagesize($this->files['tmp_name'][0]))
                {    
					$this->error .= $this->files['name'][0].' зургийн файл биш байна.';
                }    
            }
        }
    }

    function first_values($_prefix, $suffix_, $size_type_file, $size_files) 
	{
        $this->suffix_			=	$suffix_;
        $this->_prefix			=	$_prefix;
        $this->size_type_file 	= 	$size_type_file;
        $this->size_files 		= 	$size_files;
    }

    function picture_edit_values ($picture_edit, $pic_width, $pic_height, $pic_size_type, $picture_size) 
	{
        $this->picture_edit 	= $picture_edit;
        $this->pic_width 		= $pic_width;
        $this->pic_height 		= $pic_height;
        $this->pic_size_type 	= $pic_size_type;
        $this->picture_size 	= $picture_size;
    }
    
    function picture_edit_thumb_values($thumb_picture, $thumb_pic_dir, $thumb_pic_width, $thumb_pic_height,$thumb_pic_extension) 
	{
        $this->thumb_picture 		= $thumb_picture;
        $this->thumb_pic_dir 		= $thumb_pic_dir;
       	$this->thumb_pic_width 		= $thumb_pic_width;
	 	$this->thumb_pic_height 	= $thumb_pic_height;
        $this->thumb_pic_extension 	= $thumb_pic_extension;
    }

    function uploader_set($file, $name, $upload_dir, $mime_types) 
	{    
        $this->upload_dir($upload_dir);
        $this->files($file);
		$this->picture_names($name);
        $this->is_file_extension($mime_types);
        $this->size_find();
        $this->image_control();
        $this->upload();
    }
}

?>
