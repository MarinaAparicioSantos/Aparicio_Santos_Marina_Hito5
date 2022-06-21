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
            <title>Reserva de la obra pujada</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
            <link rel="stylesheet" href="assets/css/tipografia.css">
        </head>

        <body>

            <div class="container col-12 col-sm-12 col-md-12 g-2">

                <a href=<?php echo 'index.php?controller=obras&action=subastaObra&id=' . $_GET["id"] ?> class="btn-flotante">
                    🢀 </a>

                <h1 style="text-align: center;">Reserva de la obra pujada</h1>

                <div class="row mt-5 mb-5">

                    <div class="col-12 col-sm-12 col-md-4" style="text-align: center;">

                        <form class="row g-5 needs-validation mt-5" method="POST" action="<?php echo 'index.php?controller=obras&action=reservaObra&id=' . $_GET['id'] ?>" novalidate>
                            <div class="row g-3 align-items-center">
                                <div class="col-3 col-md-3">
                                    <label for="dni" class="col-form-label">DNI</label>
                                </div>
                                <div class="col-auto">
                                    <input name="dni" type="text" id="dni" class="form-control">
                                </div>
                            </div>

                            <div class="col-3 col-sm-3 col-md-3 offset-md-4">
                                <button class="btn btn-dark mt-5" type="submit">Enviar</button>
                            </div>
                            <span><?php echo $error; ?></span>
                        </form>

                    </div>

                    <div class=" col-12 col-sm-12 col-md-6" style="text-align: center;">

                        <div class="row g-5 mt-3 mb-3">

                            <div class="border border-dark border-2" style="width: 500px">
                                <div class="col-12 col-sm-12 col-md-12">
                                    <h1><?php echo $subasta['nombreObra']; ?></h1>
                                </div>

                                <div class="col-12 col-sm-12 col-md-12">
                                    <h2><?php echo $subasta['nombreArtistico']; ?></h2>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class=" col-12 col-sm-12 col-md-2" style="text-align: center;">

                        <div class="row g-5 mt-3 mb-3">

                            <div class=" col-12 col-sm-12 col-md-6">
                                <div class="border border-dark border-2" style="width: 250px;">
                                    <h5 class="display-1"><?php echo $precioAlto['precio'] . "€" ?></h5>
                                </div>
                            </div>

                        </div>
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