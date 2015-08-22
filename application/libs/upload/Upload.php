<?php

class Upload 
{
    private $_authorized_extensions = array('png', 'jpg', 'jpeg');
    private $_authorized_extensions_full = array('.png', '.jpg', '.jpeg');
    private $_authorized_max_size = 5120000;

    private $_file;

    private $_content_type;
    private $_size;

    private $_name;
    private $_extension;
    private $_extension_full;
    private $_directory;
    private $_quality = 100;
    private $_watermark;


    /**
     * Permet de convertir, en jpg, une image au format png 
     * @param string $originalSource L'image source
     * @param string $outputSource L'image de sortie
     * @param integer $quality La qualité de l'image
     * @return type
    */
    public function png2jpg($originalSource, $outputSource, $quality = 100) {

        $input = imagecreatefrompng($originalSource);
        list($width, $height) = getimagesize($originalSource);
        $output = imagecreatetruecolor($width, $height);
        $white = imagecolorallocate($output,  255, 255, 255);
        imagefilledrectangle($output, 0, 0, $width, $height, $white);
        imagecopy($output, $input, 0, 0, 0, 0, $width, $height);
        return imagejpeg($output, $outputSource, 100);

    }
    
    /**
     * Permet d'appliquer un type de filtre
     * @param string $originalSource L'image source
     * @param string $outputSource L'image de sortie
     * @param integer $quality La qualité de l'image
     * @return type
    */
    public function blur($originalSource, $outputSource, $quality = 100, $loop = 10) {
        $input = imagecreatefromjpeg($originalSource);
        list($width, $height) = getimagesize($originalSource);
        $output = imagecreatetruecolor($width, $height);
        $i = 0;
        while($loop > $i){
            imagefilter($input, IMG_FILTER_GAUSSIAN_BLUR);
            imagefilter($input, IMG_FILTER_SELECTIVE_BLUR);
            $i++;
        }
        imagecopy($output, $input, 0, 0, 0, 0, $width, $height);
        return imagejpeg($output, $outputSource, 100);
        
    }

    /**
     * Permet de créer les dossiers en recursif
     * Par exemple, on donne dir1/dir2/dir3/dir4/dir5/ ... il va créer "dir4" et "dir5" si "dir1/dir2/dir3" existe déjà...
     * @param type $directory
    */
    public function directory_create($directory) {
            
            $dir = explode('/', $directory);
            //-- On vire les entrées vides
            foreach($dir as $value) {
                if(!empty($value)) { $directory[] = $value; }
            }
            $i = count($directory);
            // -- Permet de savoir a quel endroit dans le tableau il faut mkdir() !
            while( $i > 0 ) {
                $j = 0; $dir_to_test = "";
                // -- Construction du lien a tester
                while($j < $i) { $dir_to_test .= $directory[$j] . '/'; $j++; }
                if( file_exists($dir_to_test) ){ break; }
                $i--;
            } 
            // -- Permet de recréer les dossiers qui ne sont pas 
            $j = 0; $dir = "";
            while( $i < count($directory) ) {
                while($j <= $i) { $dir .= $directory[$j]. '/'; $j++; }
                mkdir($dir, 0775);
                $i++;
            }
        }
       
    public function image_handler($source_image, $destination, $tn_w = 100, $tn_h = 100, $quality = 80, $wmsource = false) {

        #find out what type of image this is
        $info = getimagesize($source_image);
        $imgtype = image_type_to_mime_type($info[2]);

        #assuming the mime type is correct
        switch ($imgtype) {
            case 'image/jpeg':
                $source = imagecreatefromjpeg($source_image);
            break;
            case 'image/gif':
                $source = imagecreatefromgif($source_image);
            break;
            case 'image/png':
                $source = imagecreatefrompng($source_image);
            break;
            default:
                die('Invalid image type.');
        }

        #Figure out the dimensions of the image and the dimensions of the desired thumbnail
        $src_w = imagesx($source);
        $src_h = imagesy($source);
        $src_ratio = $src_w/$src_h;

        if( empty($tn_h) ){
           $tn_h = $tn_w/$src_ratio;
        }

        if ($tn_w/$tn_h > $src_ratio) {
            $new_h = $tn_w/$src_ratio;
            $new_w = $tn_w;
        } 
        else {
            $new_w = $tn_h*$src_ratio;
            $new_h = $tn_h;
        } 
        #Do some math to figure out which way we'll need to crop the image
        #to get it proportional to the new size, then crop or adjust as needed
  
        $x_mid = $new_w/2;
        $y_mid = $new_h/2;
        $newpic = imagecreatetruecolor(round($new_w), round($new_h));
        imagecopyresampled($newpic, $source, 0, 0, 0, 0, $new_w, $new_h, $src_w, $src_h);
        $final = imagecreatetruecolor($tn_w, $tn_h);
        //imagecopyresampled($final, $newpic, 0, 0, 0, 0, $tn_w, $tn_h, $tn_w, $tn_h);
        imagecopyresampled($final, $newpic, 0, 0, ($x_mid-($tn_w/2)), ($y_mid-($tn_h/2)), $tn_w, $tn_h, $tn_w, $tn_h);

        #if we need to add a watermark
        if($wmsource) {
            #find out what type of image the watermark is
            $info = getimagesize($wmsource);
            $imgtype = image_type_to_mime_type($info[2]);

            #assuming the mime type is correct
            switch ($imgtype) {
                case 'image/jpeg':
                    $watermark = imagecreatefromjpeg($wmsource);
                break;
                case 'image/gif':
                    $watermark = imagecreatefromgif($wmsource);
                break;
                case 'image/png':
                    $watermark = imagecreatefrompng($wmsource);
                break;
                default:
                    die('Invalid watermark type.');
            }

            #if we're adding a watermark, figure out the size of the watermark
            #and then place the watermark image on the bottom right of the image
            $wm_w = imagesx($watermark);
            $wm_h = imagesy($watermark);
            imagecopy($final, $watermark, $tn_w - $wm_w, $tn_h - $wm_h, 0, 0, $tn_w, $tn_h);
        }
        if(Imagejpeg($final,$destination,$quality)) {
          return true;
        }
        return false;
    }   
        

    // GETTER       

    public function get_authorized_extensions() {
        return $this->_authorized_extensions;
    }

    public function get_authorized_extensions_full() {
        return $this->_authorized_extensions_full;
    }

    public function get_authorized_max_size() {
        return $this->_authorized_max_size;
    }

    public function get_file() {
        return $this->_file;
    }

    public function get_content_type() {
        return $this->_content_type;
    }

    public function get_size() {
        return $this->_size;
    }

    public function get_name() {
        return $this->_name;
    }

    public function get_extension() {
        return $this->_extension;
    }

    public function get_extension_full() {
        return $this->_extension_full;
    }

    public function get_directory() {
        return $this->_directory;
    }

    public function get_quality() {
        return $this->_quality;
    }

    public function get_watermark() {
        return $this->_watermark;
    }


    // SETTER

    public function set_authorized_extensions($_authorized_extensions) {
        $this->_authorized_extensions = $_authorized_extensions;
    }

    public function set_authorized_extensions_full($_authorized_extensions_full) {
        $this->_authorized_extensions_full = $_authorized_extensions_full;
    }

    public function set_authorized_max_size($_authorized_max_size) {
        $this->_authorized_max_size = $_authorized_max_size;
    }

    public function set_file($_file) {
        $this->_file = $_file;
    }

    public function set_content_type($_content_type) {
        $this->_content_type = $_content_type;
    }

    public function set_size($_size) {
        $this->_size = $_size;
    }

    public function set_name($_name) {
        $this->_name = $_name;
    }

    public function set_extension($_extension) {
        $this->_extension = $_extension;
    }

    public function set_extension_full($_extension_full) {
        $this->_extension_full = $_extension_full;
    }

    public function set_directory($_directory) {
        $this->_directory = $_directory;
    }

    public function set_quality($_quality) {
        $this->_quality = $_quality;
    }

    public function set_watermark($_watermark) {
        $this->_watermark = $_watermark;
    }

}