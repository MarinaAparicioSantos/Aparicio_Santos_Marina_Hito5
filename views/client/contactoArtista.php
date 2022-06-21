<?php
if (isset($_SESSION['tipo'])) :

    if ($_SESSION['tipo'] == "cliente") :

?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Contacto artista</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
            <link rel="stylesheet" href="assets/css/tipografia.css">

        </head>

        <body>

            <div class="container col-12 col-sm-12 col-md-12 g-2">

            <a href=<?php echo 'index.php?controller=obras&action=reservaObra&id=' . $_GET["id"] ?> class="btn-flotante">
                    🢀 </a>

                        <h1 style="text-align: center;">Contacto del propietario de la obra.</h1>

                        <div class="row mt-5 mb-5">

                            <div class=" col-12 col-sm-12 col-md-6 offset-md-3">

                                <div class="row g-5 mt-3 mb-3">

                                    <div class="col-12 col-sm-12 col-md-12">
                                        <h3>Enhorabuena, ha ganado la subasta de la obra <ins><?php echo $subasta['nombreObra']?></ins>, por favor, 
                                            contacte conmigo para adquirir la obra, por favor, escríbame un mail para confirmar
                                            la compra. Un saludo.</h3>
                                    </div>

                                    <div class="col-12 col-sm-12 col-md-12">
                                        <h5>Nombre y apellidos: </h5><?php echo $subasta['nombre'] . " " . $subasta['apellido1'] . " " . $subasta['apellido2']; ?>
                                    </div>

                                    <div class="col-12 col-sm-12 col-md-12">
                                        <h5>Correo: </h5><?php echo $subasta['correo'] ?>
                                    </div>

                                    <?php

                                    if (!empty($subasta['redSocial'])) :

                                    ?>

                                        <div class="col-12 col-sm-12 col-md-12">
                                            <h5>Red social: </h5><?php echo $subasta['redSocial'] ?>
                                        </div>

                                    <?php

                                    endif;

                                    ?>

                                </div>
                            </div>
                        </div>
            </div>
        </body>

        </html>


<?php

    endif;
endif;

?>