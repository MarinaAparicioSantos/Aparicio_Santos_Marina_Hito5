<?php

if (isset($_SESSION['tipo'])) :

    if ($_SESSION['tipo'] == "cliente" || $_SESSION['tipo'] == "artista") :

?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Subasta</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
            <script type="text/javascript" src="assets/jQuery/tooltips.js"></script>
            <script type="text/javascript" src="assets/javaScript/cuentaAtras.js"></script>
            <script type="text/javascript" src="assets/ajax/ajaxSubasta.js"></script>
            <link rel="stylesheet" href="assets/css/tipografia.css">

        </head>

        <body>

            <div class="idSubasta" id='<?php echo $_GET['id'] ?>' style="display:none"></div>
            <label id="correoCliente" value='' style="display:none"></label>

            <div class="container col-12 col-sm-12 col-md-12 g-2">

                <a href=<?php

                        if (!isset($_SESSION['tipo'])) {

                            echo 'index.php?controller=usuarios&action=login';
                        } elseif (isset($_SESSION['tipo'])) {

                            if ($_SESSION['tipo'] == "cliente") {

                                echo 'index.php?controller=obras&action=index';
                            } elseif ($_SESSION['tipo'] == "artista") {

                                echo 'index.php?controller=obras&action=misSubastas';
                            }
                        }

                        ?> class="btn-flotante">
                    🢀 </a>

                <h1 id="nombreObra" value='<?php echo " " . $subasta['nombreObra'] ?>' style="text-align: center;">Subasta de la obra <?php echo " " . $subasta['nombreObra'] ?></h1>

                <div class="row mt-5 mb-5">

                    <div class="col-12 col-sm-12 col-md-3" style="text-align: center;">

                        <div class="row g-3 mt-3 mb-3">

                            <img class="imagenPuja" src="./images/<?php echo $subasta['fotoObra'] ?>" width="50%" height="50%" />

                            <div class="col-12 col-sm-12 col-md-12">
                                <h3><?php echo $subasta['nombreObra'] ?></h3>
                            </div>

                            <div class="col-12 col-sm-12 col-md-12">
                                <h5><?php echo $subasta['nombreArtistico'] ?></h5>
                                <p><?php echo wordwrap($subasta['descripcion'], 30, "<br>", TRUE); ?></p>
                                
                            </div>

                        </div>

                    </div>

                    <div class=" col-12 col-sm-12 col-md-6" style="text-align: center;">

                        <div class="row g-5 mt-3 mb-3">

                            <div class="col-12 col-sm-12 col-md-12">
                                <div class="border border-dark border-2">
                                    Contador tiempo restante
                                    <p>
                                        <span id="days"></span> días / <span id="hours"></span> horas / <span id="minutes"></span> minutos / <span id="seconds"></span> segundos
                                    </p>
                                </div>
                            </div>

                            <div class="col-12 col-sm-12 col-md-12">
                                <div class="border border-dark border-2">
                                    Contador clientes:
                                    <p>
                                        <span class='<?php echo $numClientes['clientes']; ?>' id="clientes" value='<?php echo $numClientes['clientes']; ?>'><?php echo $numClientes['clientes']; ?></span> clientes
                                    </p>
                                </div>
                            </div>

                            <div class=" col-12 col-sm-12 col-md-6">
                                <div class="border border-dark border-2">
                                    Precio inicial:
                                    <span><?php echo $subasta['precioInicial'] . "€" ?></span>
                                </div>
                            </div>

                            <div class=" col-12 col-sm-12 col-md-6">
                                <div class="border border-dark border-2">
                                    Mayor precio propuesto:
                                    <span id='precio'></span>

                                </div>
                            </div>

                            <?php

                            if (isset($_SESSION['tipo'])) :

                                if ($_SESSION['tipo'] == "cliente") :
                            ?>

                                    <form class="row g-3 needs-validation form-register" id="proponerPrecio" style="display:block" enctype="multipart/form-data" action=<?php echo "index.php?controller=obras&action=subastaObra&id=" . $_GET['id'] ?> method="POST" novalidate>
                                        <div class="row g-3 align-items-center">
                                            <div class="col-3 col-md-3">
                                                <label for="proponerPrecio" class="col-form-label">Proponer precio</label>
                                            </div>
                                            <div class="col-auto">
                                                <input type="number" name="proponerPrecio" id="proponerPrecio" class="form-control">
                                            </div>

                                            <span class="text-danger"><small><?php echo $error, $errorPrecioInicial, $errorPrecio; ?></small></span>

                                        </div>

                                        <div class="col-3 col-sm-3 col-md-3 offset-md-4">
                                            <button class="btn btn-dark mt-5" type="submit">Enviar</button>
                                        </div>
                                    </form>

                            <?php

                                endif;
                            endif;
                            ?>


                        </div>
                    </div>


                    <div class=" col-12 col-sm-12 col-md-3" style="text-align: center;">

                        <div class="row g-5 mt-3 mb-3">

                            <div class=" col-12 col-sm-12 col-md-6">
                                <div class="border border-dark border-2">
                                    Inicio de subasta:
                                    <small><?php echo $subasta['fechaInicioSubasta'] ?></small>
                                </div>
                            </div>

                            <div class=" col-12 col-sm-12 col-md-6">
                                <div id="finSubasta" value='<?php echo $subasta['fechaFinSubasta'] ?>' class="border border-dark border-2">
                                    Fin de subasta:
                                    <small><?php echo $subasta['fechaFinSubasta'] ?></small>
                                </div>
                            </div>

                        </div>
                        <span class="display-6" id="ganador"></span>
                        <br><br>
                        <span id="hasGanado"></span>
                        <?php

                        if (isset($_SESSION['tipo'])) :

                            if ($_SESSION['tipo'] == "cliente") :

                                if ($_SESSION['dni'] == $precioAlto['dni_cliente']) :


                        ?>
                                    <div id="reserva" class=" col-12 col-sm-12 col-md-12" style="display:none">

                                        <a class="btn btn-success mt-5 btn-lg" href=<?php echo "index.php?controller=obras&action=reservaObra&id=" . $_GET['id']; ?> role="button">Reservar obra</a>

                                    </div>

                        <?php

                                endif;
                            endif;
                        endif;

                        ?>

                        <?php

                        if (isset($_SESSION['tipo'])) :

                            if ($_SESSION['tipo'] == "artista") :

                        ?>

                                <div class=" col-12 col-sm-12 col-md-12">

                                    <a class="btn btn-primary mt-5 btn-lg" href=<?php echo "index.php?controller=obras&action=editarSubasta&id=" . $_GET['id'] ?> role="button">Editar puja</a>

                                </div>

                        <?php

                            endif;
                        endif;

                        ?>
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