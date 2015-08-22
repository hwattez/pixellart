<?php

class UploadManager 
{
    /**
    * Permet d'envoyer le fichier sur le serveur et de l'associer au bon élément
    */
    public static function upload(Upload $upload, $sizes, $param = array()) {
        
        $upsError = "";
        $file = $upload->get_file();
        
        // -- On créé le dossier (ainsi que les dossiers enfants et parents) s'il n'existe pas ...
        if(!file_exists($upload->get_directory())) {
            mkdir($upload->get_directory(), 0755, true);
        }
        
        if(isset($file) && $file['error'] == 0){
        
            // On extrait (SET) l'extension "full" (avec le point devant) et le content type
            $info = getimagesize($file['tmp_name']);
            //echo "<pre>"; print_r($info); echo "</pre>";
            $upload->set_extension_full(image_type_to_extension($info[2]));
            $upload->set_content_type($info['mime']);
        
            // Si le format du fichier est autorisé ...
            if( in_array( strtolower( $upload->get_extension_full() ), $upload->get_authorized_extensions_full() ) ) { 
                
                // 1 - On SET l'extension et la taille du fichier
                $upload->set_extension( pathinfo($file['name'], PATHINFO_EXTENSION) );
                $upload->set_size($file['size']);
        
                // 2 - On fait les vérifications nécessaires (poids, extension ...)
                if( !in_array( strtolower( $upload->get_extension() ), $upload->get_authorized_extensions() ) ) { 
                    $msg = '{"status":"error", "text":"Votre fichier doit etre au format jpg ou png (format actuelle : ' . $upload->get_extension() . ')"}';
                    if($param['type'] == 'echo'){ echo $msg; return false; }
                    if($param['type'] == 'return'){ return $msg; }  
                }
                if( $file['size'] > $upload->get_authorized_max_size() ) { 
                    $msg = '{"status":"error", "text":"Votre fichier doit avoir un poids inférieur à 5Mo"}';
                    if($param['type'] == 'echo'){ echo $msg; return false; }
                    if($param['type'] == 'return'){ return $msg; }
                }
                // 3 - On renomme tout cela comme il faut ...
                $new_name = $upload->get_name() . '.' . $upload->get_extension();
             
                // 4 - On uploade ... la photo originale avant le traitement
                if(move_uploaded_file($file['tmp_name'], $upload->get_directory().$new_name)){
                    
                    $source_image = $upload->get_directory().$new_name;
                    
                    /* 5 - Si la photo originale est en PNG, on la transforme en JPG pour pouvoir mieux la traiter après ... */
                    if( $upload->get_extension() == 'png' ) {
                        $input = $source_image;
                        //$output = $upload->get_directory() . $upload->get_name() . '_originale_jpg_' . $uniqid . '.jpg';  
                        $output = $upload->get_directory() . $upload->get_name() . '.jpg'; 
                        /* Dans le cas ou ... la source devient la nouvelle image originale en jpg et l'extension c'est jpg (celle de la source) */
                        $source_image = $output;
                        $upload->set_extension('jpg');

                        if(!$upload->png2jpg($input, $output)){
                            $msg = '{"status":"error", "text":"Oups ! Transformation en JPG impossible !"}';
                            if($param['type'] == 'echo'){ echo $msg; return false; }
                            if($param['type'] == 'return'){ return $msg; }    
                        }
                    }
                    // BLUR
                    if(isset($param['blur']) && $param['blur'] == true) {
                        $output = $upload->get_directory() . $upload->get_name() . 'originale_blur.jpg'; 
                        $input = $source_image;
                        if(!$upload->blur($input, $output)){
                            $msg = '{"status":"error", "text":"Oups ! BLUR impossible !"}';
                            if($param['type'] == 'echo'){ echo $msg; return false; }
                            if($param['type'] == 'return'){ return $msg; } 
                        }
                    }
                 
                    // 6 - On fait le traitement pour redimmensionner ...
                    foreach ($sizes as $size) {
                        $destination = $upload->get_directory() . $upload->get_name() . "_" . $size['suffix'] . '.' . $upload->get_extension();
                        $tn_w = $size['width'];
                        $tn_h = $size['height'];
                        $quality = $size['quality'];
                        $wmsource = $size['watermark'];
                        
                        // Si on doit vérifier la taille de l'image originale... (cf. conf. Object)
                        if($size['verifSize'] == true) {
                            // Si la taille (width en px) de l'image originale ($info[0]) fait moins que 
                            // la taille (width en px) a laquelle on souhaite redimensionner ($tn_w)... alors on "copy" !
                            if($info[0] < $tn_w) {
                                $success = copy($source_image, $destination);
                            }
                            else{
                                $success = $upload->image_handler($source_image, $destination, $tn_w, $tn_h, $quality, $wmsource); 
                            }
                        }
                        else{
                            $success = $upload->image_handler($source_image, $destination, $tn_w, $tn_h, $quality, $wmsource); 
                        }
                        if(!$success) { $upsError .= $file['name'] . ', '; }
                    }
                    if($upsError == '') {  
                        
                        // 7 - Si on doit copier l'image dans un autre dossier
                        if(isset($param['copy']) && $param['copy'] == true && isset($param['copy_to'])) {
                            // -- On créé le dossier (ainsi que les dossiers enfants et parents) s'il n'existe pas ...
                            if(!file_exists($param['copy_to'])) {
                               mkdir($param['copy_to'], 0755, true);  
                            }
                            //$destination = $param['copy_to'] . $upload->get_name() . '_avatar' .  '.' . $upload->get_extension();
                            $destination = $param['copy_to'] . $upload->get_name() . 'avatar.' . $upload->get_extension();
                            //$source = $upload->get_directory() . $upload->get_name() . '_profil_' . $uniqid . '.' . $upload->get_extension();
                            $source = $upload->get_directory() . $upload->get_name() . 'profil.' . $upload->get_extension();
                            copy($source, $destination);
                        }
     
                        $msg = '{"status":"success", "text":"Félicitations ! Votre photo '. $file['name'].' a bien été publiée !"}';
                        if($param['type'] == 'echo'){ echo $msg; return true; }
                        if($param['type'] == 'return'){ return $msg; }  
                    }               
                } 
                else { 
                    $msg = '{"status":"error", "text":"Oups ! Votre image '. $file['name'].' n\'a pas été publiée !"}';
                    if($param['type'] == 'echo'){ echo $msg; return false; }
                    if($param['type'] == 'return'){ return $msg; }     
                }
            } 
            else {  
                $msg = '{"status":"error", "text":"Oups ! Votre image '. $file['name'].' n\'a pas un format autorisé !"}'; 
                if($param['type'] == 'echo'){ echo $msg; return false; }
                if($param['type'] == 'return'){ return $msg; } 
            }
        }
        $msg = '{"status":"error"}';
        if($param['type'] == 'echo'){ echo $msg; return false; }
        if($param['type'] == 'return'){ return $msg; } 
    } 
}