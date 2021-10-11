<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Convertisseur d'Image</title>
        <link rel="stylesheet" href="css/bootstrap.min.css.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" href="img/logo.png">
    </head>
    <body class="d-flex
             justify-content-center
             align-items-center
             vh-100">
        <div class="w-400 p-5 shadow rounded">
            <!--POST PHP-->
            <form method="post"
                  action="convert.php"
                  enctype="multipart/form-data">
                <div class="d-flex
                            justify-content-center
                            align-items-center
                            flex-column">

                    <h3 class="display-4 fs-1
                           text-center">
                        Convertisseur d'Image</h3>
                </div>

                <!--BOITE D'ALERTE-->
                    <?php if (isset($_GET['error'])) { ?>
                <div class="alert alert-warning" role="alert">
                        <?php echo htmlspecialchars($_GET['error']);?>
                </div>
                    <?php } else { echo " ";}
                    ?>
                    <?php if (!isset($_GET['download'])) {?>

                <!--FORMULAIRE-->
                <!--WIDTH-->
                <div class="mb-3">
                    <label class="form-label">
                        Largeur</label>
                    <input type="number"
                           name="Largeur"
                           placeholder="1080"
                           class="form-control">
                </div>

                <!--HEIGHT-->
                <div class="mb-3">
                    <label class="form-label">
                        Hauteur</label>
                    <input type="number"
                           name="Hauteur"
                           placeholder="720"
                           class="form-control">
                </div>

                <!--FORMAT-->
                <div class="mb-3">
                    <label class="form-label">
                        Format</label>
                    <input type="text"
                           name="Format"
                           placeholder=".jpg / .png / .gif"
                           class="form-control">
                </div>

                <!--PHOTO-->
                <div class="mb-3">
                    <label class="form-label">
                        Photo</label>
                    <input type="file"
                           class="form-control"
                           name="Photo"
                           value="">
                </div>

                    <!--BOUTON POUR TELECHARGER-->
                    <?php }if (isset($_GET['download'])) {
                    echo '</form><br>
                            <div align="center">
                            <a
                            href="'.$_GET['download'].'"
                            download="'.$_GET['download'].'"
                            class="btn btn-primary">
                            Télècharger</a> ';
                    echo '<a href="index.php">Nouvelle Convertion</a></div>';
                    }else{?>

                <!--BOUTON CONVERTIR-->
                <div align="center">
                <button type="submit"
                        class="btn btn-primary">
                    Convertir</button>
                    <a href="index.php">Nouvelle Convertion</a></div>
                 </form>
                <?php } ?>

    </body>
</html>