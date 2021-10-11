<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Convertisseur d'Image</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">-
        <!--<link rel="icon" href="img/logo.png">-->
    </head>
    <body class="d-flex justify-content-center align-items-center vh-100">
        <div class="w-400 p-5 shadow rounded">
            <!--POST PHP-->
            <form method="post" action="convert.php" enctype="multipart/form-data">

                <div class="d-flex justify-content-center align-items-center flex-column">
                    <h3 class="display-4 fs-1 text-center">Convertisseur d'Image</h3>
                </div>

                <!--BOITE D'ALERTE-->
                <?php if (isset($_GET['erreur'])) { ?>
                    <div class="alert alert-warning" role="alert" style="text-align: center;">
                            <?php echo htmlspecialchars($_GET['erreur']);?>
                    </div>
                <?php } else { echo " ";} ?>
                <?php if (!isset($_GET['download'])) {?>

                <!--FORMULAIRE-->
                <!--WIDTH-->
                <div class="mb-3">
                    <label class="form-label" for="largeur">
                        Largeur</label>
                    <input type="number"
                           name="Largeur"
                           id="largeur"
                           placeholder="1080"
                           class="form-control">
                </div>

                <!--HEIGHT-->
                <div class="mb-3">
                    <label class="form-label" for="hauteur">
                        Hauteur</label>
                    <input type="number"
                           name="Hauteur"
                           id="hauteur"
                           placeholder="720"
                           class="form-control">
                </div>

                <!--FORMAT-->
                <div class="mb-3">
                    <label class="form-label" for="format">
                        Format</label>
                    <input type="text"
                           name="Format"
                           id="format"
                           placeholder=".jpg / .png / .gif"
                           class="form-control">
                </div>

                <!--PHOTO-->
                <div class="mb-3">
                    <label class="form-label" for="photo">
                        Photo</label>
                    <input type="file"
                           class="form-control"
                           name="Photo"
                           id="photo"
                           value="">
                </div>

                <!--BOUTON POUR TELECHARGER-->
                <?php }if (isset($_GET['download'])) {
                    echo '</form><br>
                            <div style="text-align: center;">
                            <a href="'.$_GET['download'].'"
                            download="'.$_GET['download'].'"
                            class="btn btn-primary">
                            Télécharger</a> ';
                    echo '<a href="index.php">Nouvelle Convertion</a></div>';
                }else{?>

                <!--BOUTON CONVERTIR-->
                <div style="text-align: center;">
                    <button type="submit" class="btn btn-primary">Convertir</button>
                    <a href="index.php">Nouvelle Convertion</a>
                </div>

            </form>
                  <?php } ?>
    </body>
</html>