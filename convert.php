<?php


    # RECUPERER LES DONNEES
    $width = $_POST['Largeur'];
    $height = $_POST['Hauteur'];
    $format = $_POST['Format'];

    #VALIDATION
    if (empty($width)) {
        # MESSAGE ERREUR + REDIRECTION
        $em = "Vous n'avez pas renseignez de Largeur !";
        header("Location: /index.php?error=$em");
        exit;
    }else if(empty($height)){
        # MESSAGE ERREUR + REDIRECTION
        $em = "Vous n'avez pas renseignez de Hauteur !";
        header("Location: /index.php?error=$em");
        exit;
    }else {
        if (empty($format)) {
            # MESSAGE ERREUR + REDIRECTION
            $em = "Vous n'avez pas renseignez de Format !";
            header("Location: /index.php?error=$format");
            exit;
        } else {

            # TELECHARGEMENT DE LA PHOTO
            if (isset($_FILES['Photo'])) {
                # get data and store them in var
                $img_name = $_FILES['Photo']['name'];
                $tmp_name = $_FILES['Photo']['tmp_name'];
                $error = $_FILES['Photo']['error'];


                # SI IL N'Y A PAS D'ERREUR DE TELECHARGEMENT
                if ($error === 0) {

                    # OBTENIR L'EXTENSION DU FICHIER
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);

                    # CONVETIR L'EXTENSION EN MINUSCULE
                    $img_ex_lc = strtolower($img_ex);

                    #VERIFIER LES L'EXTENTION ACCEPTER
                    $allowed_exs = array("jpg", "jpeg", "png", "gif");

                    # SI L'EXTENTTION EST VALIDE
                    if (in_array($img_ex_lc, $allowed_exs)) {
                        # CHANGER LE FORMAT DE L'IMAGE
                        switch ($format) {
                            case $format == ".jpg":
                                $image = substr($img_name, 0, -4) . '.jpg';
                                break;
                            case $format == ".jpeg":
                                $image = substr($img_name, 0, -5) . '.jpg';
                                break;
                            case $format == ".png":
                                $image = substr($img_name, 0, -4) . '.png';
                                break;
                            case $format == ".gif":
                                $image = substr($img_name, 0, -4) . '.gif';
                                break;
                            default :
                                $em = "Mauvais format de convertion";
                                header("Location: index.php?error=$em");
                                exit;
                        }

                            # CHEMIN DE TELECHARGEMENT
                            $img_upload_path = 'uploads/' . $image;

                            # DEPLACER L'IMAGE VERS LE DOSSIER
                            move_uploaded_file($tmp_name, $img_upload_path);

                            #RECUPERER LA TAILLE DE L'IMAGE
                            $info = getimagesize($img_upload_path);
                            $mime = $info['mime'];

                        switch ($mime) {
                            case 'image/jpg':
                                $image_create_func = 'imagecreatefromjpg';
                                $image_save_func = 'imagejpg';
                                break;
                            case 'image/jpeg':
                                $image_create_func = 'imagecreatefromjpeg';
                                $image_save_func = 'imagejpeg';
                                break;
                            case 'image/png':
                                $image_create_func = 'imagecreatefrompng';
                                $image_save_func = 'imagepng';
                                break;
                            case 'image/gif':
                                $image_create_func = 'imagecreatefromgif';
                                $image_save_func = 'imagegif';
                                break;
                            default:
                                $em = "Mauvais format d'image";
                                header("Location: index.php?error=$em");
                                exit;
                        }
                            #RECUPERER LA TAILLE DE L'IMAGE
                            list($width_b, $height_b) = getimagesize($img_upload_path);
                            # CREATION DU NOUVEAU FORMAT D'IMAGE
                            $tn = imagecreatetruecolor($width, $height) ;
                            # RECUPERATION DE L'IMAGE
                            $images = $image_create_func($img_upload_path) ;
                            # COPIER / REDIMENSIONNER L'IMAGE
                            imagecopyresampled($tn, $images, 0, 0, 0, 0, $width, $height, $width_b, $height_b) ;
                            $image_save_func($tn, $img_upload_path) ;

                    } else {
                        # MAUVAIS FICHIER
                        $em = "Vous ne pouvez pas importer ce type de fichier";
                        header("Location: index.php?error=$em");
                        exit;
                    }

                }
            }
        }
    }

    # SI L'IMAGE EXISTE
    if (file_exists($img_upload_path)) {
        # REDIRECTION VERS LA PAGE DE TELECHARGEMENT
        $sm = "Vous Pouvez Télècharger";
        header("Location: index.php?download=$img_upload_path");
        exit;
    }
    else {
        # ECHEC ET REDIRECTION
        $sm = "Echec";
        header("Location: index.php?error=$sm");
        exit;
    }



?>