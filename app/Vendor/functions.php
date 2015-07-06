<?php 
function show_formatted_date($p_date ='') {
    if ($p_date == '0000-00-00 00:00:00' || $p_date == '0000-00-00' || $p_date == '')
        return 'NA';
    else
        return date('d F Y', strtotime($p_date));
}

function show_formatted_datetime($p_date='') {
    if ($p_date == '0000-00-00 00:00:00' || $p_date == '0000-00-00' || $p_date == '')
        return 'NA';
    else
        return date(' F d, Y h:i A', strtotime($p_date));
}

function random_password($length = 8)
{
    $password = "";
    $possible = "2346789bcdfghjkmnpqrtvwxyzBCDFGHJKLMNPQRTVWXYZ";
    $maxlength = strlen($possible);
    if ($length > $maxlength) {
            $length = $maxlength;
	}
    $i = 0;
    while ($i < $length) {
    $char = substr($possible, mt_rand(0, $maxlength-1), 1);
    if (!strstr($password, $char)) {
  
            $password .= $char;            
            $i++;
	}
}
return $password;
}

function upload_my_file($upload_file, $destination) {

    if(move_uploaded_file($upload_file, $destination)) {
        return true;
    }else{
        return false;
    }
}

   
function encrypt($string, $key) {
    $result = '';
    for($i = 0; $i < strlen($string); $i++) {
    	$char = substr($string, $i, 1);
    	$keychar = substr($key, ($i % strlen($key))-1, 1);
    	$char = chr(ord($char) + ord($keychar));
    	$result .= $char;
    }
    return base64_encode($result);
}

function decrypt($string, $key) {
    $result = '';
    $string = base64_decode($string);

    for($i = 0; $i < strlen($string); $i++) {
    	$char = substr($string, $i, 1);
    	$keychar = substr($key, ($i % strlen($key))-1, 1);
    	$char = chr(ord($char) - ord($keychar));
    	$result .= $char;
    }
    return $result;
}

function removeSpecialChar($image_name) {

    $image_name = str_replace(" ", "", $image_name);
    $image_name = str_replace("(", "", $image_name);
    $image_name = str_replace(")", "", $image_name);
    $image_name = str_replace("{", "", $image_name);
    $image_name = str_replace("}", "", $image_name);
    $image_name = str_replace("[", "", $image_name);
    $image_name = str_replace("]", "", $image_name);

    return $image_name;
}

function create_thumb($path, $size, $save_path) {
	
    if (file_exists($path)) {
		
        $thumb = new my_thumbnail($path); // generate image_file, set filename to resize
        $thumb->size_width(500);  // set width for thumbnail, or
        $thumb->size_height(500);  // set height for thumbnail, or
        $width = $thumb->img["lebar"];
        $height = $thumb->img["tinggi"];
        if ($width > $size || $height > $size) {
            $size = $size;
        } else {
            $size = $width;
        }
		
        $thumb->size_auto($size);  // set the biggest width or height for thumbnail
        $thumb->jpeg_quality(100);  // [OPTIONAL] set quality for jpeg only (0 - 100) (worst - best), default = 75
        $thumb->save($save_path);  // save your thumbnail to file
    } else {
       return false;
    }
}

/* ---------------------------------------------- */

class my_thumbnail {

    var $img;

    function my_thumbnail($imgfile) {

        //
        //detect image format

        $this->img["format"] = ereg_replace(".*\.(.*)$", "\\1", $imgfile);

        $this->img["format"] = strtoupper($this->img["format"]);

        if ($this->img["format"] == "JPG" || $this->img["format"] == "JPEG") {

            //JPEG



            $this->img["format"] = "JPEG";

            $this->img["src"] = ImageCreateFromJPEG($imgfile);
        } elseif ($this->img["format"] == "PNG") {

            //PNG

            $this->img["format"] = "PNG";

            $this->img["src"] = ImageCreateFromPNG($imgfile);
        } elseif ($this->img["format"] == "GIF") {

            //GIF

            $this->img["format"] = "GIF";

            $this->img["src"] = ImageCreateFromGIF($imgfile);
        } elseif ($this->img["format"] == "WBMP") {

            //WBMP

            $this->img["format"] = "WBMP";

            $this->img["src"] = ImageCreateFromWBMP($imgfile);
        } else {

            //DEFAULT

            echo "error|Not Supported File";

            return;
        }



        @$this->img["lebar"] = imagesx($this->img["src"]);

        @$this->img["tinggi"] = imagesy($this->img["src"]);



        //default quality jpeg

        $this->img["quality"] = 100;
    }

    function size_height($size=100) {

        //height

        $this->img["tinggi_thumb"] = $size;



        @$this->img["lebar_thumb"] = ($this->img["tinggi_thumb"] / $this->img["tinggi"]) * $this->img["lebar"];
    }

    function size_width($size=100) {

        //width

        $this->img["lebar_thumb"] = $size;

        @$this->img["tinggi_thumb"] = ($this->img["lebar_thumb"] / $this->img["lebar"]) * $this->img["tinggi"];
    }

    function size_auto($size=100) {

        //size

        if ($this->img["lebar"] >= $this->img["tinggi"]) {

            $this->img["lebar_thumb"] = $size;

            @$this->img["tinggi_thumb"] = ($this->img["lebar_thumb"] / $this->img["lebar"]) * $this->img["tinggi"];
        } else {

            $this->img["tinggi_thumb"] = $size;

            @$this->img["lebar_thumb"] = ($this->img["tinggi_thumb"] / $this->img["tinggi"]) * $this->img["lebar"];
        }
    }

    function jpeg_quality($quality) {

        //jpeg quality

        $this->img["quality"] = $quality;
    }

    function show() {

        //show thumb

        @Header("Content-Type: image/" . $this->img["format"]);



        /* change ImageCreateTrueColor to ImageCreate if your GD not supported ImageCreateTrueColor function */

        $this->img["des"] = ImageCreateTrueColor($this->img["lebar_thumb"], $this->img["tinggi_thumb"]);

        imagecopyresampled($this->img["des"], $this->img["src"], 0, 0, 0, 0, $this->img["lebar_thumb"], $this->img["tinggi_thumb"], $this->img["lebar"], $this->img["tinggi"]);



        if ($this->img["format"] == "JPG" || $this->img["format"] == "JPEG") {

            //JPEG

            imageJPEG($this->img["des"], "", $this->img["quality"]);
        } elseif ($this->img["format"] == "PNG") {

            //PNG

            imagePNG($this->img["des"]);
        } elseif ($this->img["format"] == "GIF") {

            //GIF

            imageGIF($this->img["des"]);

//			echo "$path";
        } elseif ($this->img["format"] == "WBMP") {

            //WBMP

            imageWBMP($this->img["des"]);
        }
    }

    function save($save="") {

        //save thumb

        if (empty($save))
            $save = strtolower("./thumb." . $this->img["format"]);

        /* change ImageCreateTrueColor to ImageCreate if your GD not supported ImageCreateTrueColor function */

        $this->img["des"] = ImageCreateTrueColor($this->img["lebar_thumb"], $this->img["tinggi_thumb"]);

        @imagecopyresampled($this->img["des"], $this->img["src"], 0, 0, 0, 0, $this->img["lebar_thumb"], $this->img["tinggi_thumb"], $this->img["lebar"], $this->img["tinggi"]);



        if ($this->img["format"] == "JPG" || $this->img["format"] == "JPEG") {

            //JPEG

            imageJPEG($this->img["des"], "$save", $this->img["quality"]);
        } elseif ($this->img["format"] == "PNG") {

            //PNG

            imagePNG($this->img["des"], "$save");
        } elseif ($this->img["format"] == "GIF") {

            //GIF

            imageGIF($this->img["des"], "$save");
        } elseif ($this->img["format"] == "WBMP") {

            //WBMP

            imageWBMP($this->img["des"], "$save");
        }
    }

}

function wraptext($text, $len="") {
    $text = nl2br(stripslashes($text));
    //		$text=str_replace(array('<!--', '-->'), array('&lt;!--', '--&gt;'), $text);
    $text = strip_tags($text);
    $words = explode("<br />", $text, 2);
    $text = $words[0];

    if ($len == "") {
        $count_chars = 100;
    } else {
        $count_chars = $len;
    }
    if (strlen($text) > $count_chars) {
        $str_new = substr($text, 0, $count_chars);
        $str_new.="...";
        return $str_new;
    } else {
        return $text;
    }
}

function calculate_price($price,$discount,$type){
	
	$netPrice=0; 
	if(!empty($price) && !empty($discount) && !empty($type)){	
		
		if($type=='Percent'){
			
			$amt=((int)$discount/100)*(int)$price;
			
			$netPrice=(int)$price-$amt;		
		}else if($type=='Pure Value'){
			
			$netPrice=(int)$price-(int)$discount;	
		}		
	}
	return $netPrice; 
}


?>