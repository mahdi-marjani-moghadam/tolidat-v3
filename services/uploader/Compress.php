<?php

class Compress
{

    // @var file_url
    protected $file_url;

    // @var new_name_image
    protected $new_name_image;

    // @var quality
    protected $quality;

    // @var destination
    protected $destination;

    // @var image_size
    protected $image_size;

    // @var image_data
    protected $image_data;

    // @var image_mime
    protected $image_mime;

    // @var array_img_types
    protected $array_img_types;

    public function __construct($file_url = null, $new_name_image = null, $quality = 100, $destination = null)
    {
        $this->set_file_url($file_url);
        $this->set_new_name_image($new_name_image);
        $this->set_quality($quality);
        $this->set_destination($destination);
    }

    function get_file_url()
    {
        return $this->file_url;
    }

    function get_new_name_image()
    {
        return $this->new_name_image;
    }

    function get_quality()
    {
        return $this->quality;
    }

    function set_file_url($file_url)
    {
        $this->file_url = $file_url;
    }

    function set_new_name_image($new_name_image)
    {
        $this->new_name_image = $new_name_image;
    }

    function set_quality($quality)
    {
        $this->quality = $quality;
    }

    function get_destination()
    {
        return $this->destination;
    }

    function set_destination($destination)
    {
        $this->destination = $destination;
    }

    /**
     * Function to compress image
     * @return boolean
     * @throws Exception
     */
    public function compressImage($newWidth = 800, $newHeight = 400)
    {

        //Send image array
        $array_img_types = array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/png', 'image/x-png');
        $new_image = null;
        $last_char = null;
        $image_extension = null;
        $destination_extension = null;

        try {
            
            //If not found the file
            if (empty($this->file_url) && !file_exists($this->file_url)) {
                throw new Exception('Please inform the image!');
                return false;
            }
            
            //Get image width, height, mimetype, etc..
            $image_data = getimagesize($this->file_url);
            
            // echo $this->file_url;

            list($oldWidth, $oldHeight, $image_type) = $image_data;
            // dd($image_data);
            // dd($this->file_url);
            // dd(IMAGETYPE_JPEG);
            switch ($image_type) {
                case IMAGETYPE_PNG:
                    $type = 'png';
                    $blending = false;
                    break;
                case IMAGETYPE_GIF:
                    $type = 'gif';
                    $blending = true;
                    break;
                case IMAGETYPE_JPEG:
                    $type = 'jpeg';
                    break;
            }

            //Set MimeType on variable
            $image_mime = $image_data['mime'];
            // dd($image_mime);
            //Verifiy if the file is a image
            if (!in_array($image_mime, $array_img_types)) {
                throw new Exception('Please send a image!');
                return false;
            }
            // dd(33);
            
            //Get file size
            $image_size = filesize($this->file_url);

            //if image size is bigger than 5mb
            if ($image_size > 10485760) {
                throw new Exception('Please send a imagem smaller than 5mb!');
                return false;
            }

            //If not found the destination
            if (empty($this->new_name_image)) {
                throw new Exception('Please inform the destination name of image!');
                return false;
            }

            //If not found the quality
            if (empty($this->quality)) {
                throw new Exception('Please inform the quality!');
                return false;
            }
            
            $image_extension = pathinfo($this->file_url, PATHINFO_EXTENSION);
            //Verify if is sended a destination file name with extension
            $destination_extension = pathinfo($this->new_name_image, PATHINFO_EXTENSION);
            //if empty
            if (empty($destination_extension)) {
                $this->new_name_image = $this->new_name_image . '.' . $image_extension;
            }

            //Verify if folder destination isn´t empty
            if (!empty($this->destination)) {

                //And verify the last one element of value
                $last_char = substr($this->destination, -1);

                if ($last_char !== '/') {
                    $this->destination = $this->destination . '/';
                }
            }
            
            $max = max($oldWidth, $oldHeight);
            if ($max == $oldWidth) {
                $width2 = $newWidth;
                $height2 = round(($newWidth / $oldWidth) * $oldHeight);
            } else {
                $height2 = $newHeight;
                $width2 = round(($newHeight / $oldHeight) * $oldWidth);
            }
            if ($width2 > $newWidth | $height2 > $newHeight) {
                if ($max == $oldWidth) {
                    $height2 = $newHeight;
                    $width2 = round(($newHeight / $oldHeight) * $oldWidth);
                } else {
                    $width2 = $newWidth;
                    $height2 = round(($newWidth / $oldWidth) * $oldHeight);

                }
            }

            // dd(55);

            //Create a new jpg image
            $new_image = $this->createNewImage($type);

            $new_image_resize = imagecreatetruecolor($newWidth, $newHeight);
            
            // allocate a color for thumbnail
            $backgroundColor = imagecolorallocate($new_image_resize, 255, 255, 255);
            imagefill($new_image_resize, 0, 0, $backgroundColor);

            if ($image_mime == 'png' || $image_mime == 'gif') {

                // allocate a color for thumbnail
                $background = imagecolorallocate($new_image_resize, 255, 255, 255);
                // define a color as transparent
                imagecolortransparent($new_image_resize, $background);
                // set the blending mode for thumbnail
                imagealphablending($new_image_resize, $blending);
                // set the flag to save alpha channel
                imagesavealpha($new_image_resize, true);
            }
            $x = 0;
            $y = 0;

            if ($newWidth - $width2 != 0) {
                $x = ($newWidth - $width2) / 2;
            }
            if ($newHeight - $height2 != 0) {
                $y = ($newHeight - $height2) / 2;
            }
            
            // dd(66);

            imagecopyresampled($new_image_resize, $new_image, $x, $y, 0, 0, $width2, $height2, $image_data['0'], $image_data['1']);
            $this->imageSave($type, $new_image_resize);
            // dd(33);

        } catch
        (Exception $ex) {
            return $ex->getMessage();
        }

        //Return the new image resized
        return $this->new_name_image;
    }

    public function createNewImage($type)
    {
        switch ($type) {
            case 'png' :
                return imagecreatefrompng($this->file_url);
            case 'gif' :
                return imagecreatefromgif($this->file_url);
            case 'jpeg' :
                return imagecreatefromjpeg($this->file_url);
            default :
                return null;
        }
    }

    public function imageSave($type, $new_image_resize)
    {
        switch ($type) {
            case 'png' :
                return imagepng($new_image_resize, $this->destination . $this->new_name_image, $this->quality);
            case 'gif' :
                return imagegif($new_image_resize, $this->destination . $this->new_name_image, $this->quality);
            case 'jpeg' :
                return imagejpeg($new_image_resize, $this->destination . $this->new_name_image, $this->quality);
            default :
                return null;
        }

    }

    public function resize($file, $destination, $sizes = array(), $quality = 0)
    {
        $fileArr = explode('/', $file);
        $file_name = end($fileArr);
        $extension = getimagesize($file)['mime'];

        if ($quality != 0) {
            $this->set_quality($quality);
        } else {
            if ($extension == 'image/png' || $extension == 'image/gif') {
                $this->set_quality(8);
            } else {
                $this->set_quality(90);
            }
        }
        
        $this->set_file_url($file);
        $this->set_destination($destination);

        foreach ($sizes as $key => $size) {
            $this->set_new_name_image($size['width'] . '.' . $size['height'] . '.' . $file_name);
            $images[$key] = $this->compressImage($size['width'], $size['height']);
        }

        return $images;
    }
}
