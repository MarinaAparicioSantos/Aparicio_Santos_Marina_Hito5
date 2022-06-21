<?php

if (isset($_SESSION['tipo'])) :
    if ($_SESSION['tipo'] == "artista") :

?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Crear o editar obra</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
            <script type="text/javascript" src="assets/javaScript/validacionTextAreaObra.js"></script>
            <link rel="stylesheet" href="assets/css/tipografia.css">
        </head>

        <body>

            <div class="row col-12 col-md-12">

                <div class="col-2 col-sm-2 col-md-2 mt-5 mb-5 offset-md-1"></div>
                <div class="col-12 col-md-6 mt-5 mb-5 offset-md-1">
                    <form class="row g-3 needs-validation form-register" enctype="multipart/form-data" action=<?php if (isset($_GET['action'])) {
                                                                                                                    if ($_GET['action'] == "crearObra") {

                                                                                                                        echo "index.php?controller=obras&action=crearObra";
                                                                                                                    } elseif ($_GET['action'] == "editarObra") {

                                                                                                                        echo "index.php?controller=obras&action=editarObra&id=" . $_GET['id'];
                                                                                                                    }
                                                                                                                } ?> method="POST" novalidate>

                        <a href='<?php

                                    if ($_GET['action'] == "editarObra") {

                                        echo 'index.php?controller=obras&action=detallesObra&id=' . $_GET["id"];
                                    } elseif ($_GET['action'] == "crearObra") {

                                        echo 'index.php?controller=obras&action=index';
                                    }

                                    ?>' class="btn-flotante btn-white btn-lg">
                            🢀 </a>



                        <?php

                        if ($_GET['action'] == "crearObra") :

                        ?>
                            <div class="offset-md-1">
                                <h1>Crear obra nueva</h1>
                            </div>
                        <?php

                        endif;

                        if ($_GET['action'] == "editarObra") :

                        ?>
                            <div class="offset-md-1">
                                <h1>Editar obra</h1>
                            </div>

                        <?php

                        endif;

                        ?>
                        <div class="row g-3 align-items-center">
                            <div class="col-3">
                                <label for="" class="col-form-label">
                                    <h5>Nombre de la obra</h5>
                                </label>
                            </div>
                            <div class="col-auto">
                                <input type="text" name="nombreObra" id="nombreObra" class="form-control" aria-describedby="passwordHelpInline" value="<?php if (isset($_GET['action'])) {
                                                                                                                                                            if ($_GET['action'] == "editarObra" && empty($_POST['nombreObra'])) {

                                                                                                                                                                echo $obraEditar['nombreObra'];
                                                                                                                                                            } else if (isset($_POST['nombreObra'])) {

                                                                                                                                                                echo $_POST['nombreObra'];
                                                                                                                                                            }
                                                                                                                                                        } ?>">

                            </div>
                            <span class="text-danger"><small><?php echo $errorNombre; ?></small></span>
                        </div>

                        <div class="row g-3 align-items-center">
                            <div class="col-3">
                                <label for="" class="col-form-label">
                                    <h5>Dimensiones</h5>
                                </label>
                            </div>
                            <div class="col-auto">
                                <input type="text" name="dimensiones" id="dimensiones" class="form-control" aria-describedby="passwordHelpInline" value="<?php if (isset($_GET['action'])) {
                                                                                                                                                                if ($_GET['action'] == "editarObra" && empty($_POST['dimensiones'])) {

                                                                                                                                                                    echo $obraEditar['dimensiones'];
                                                                                                                                                                } else if (isset($_POST['dimensiones'])) {

                                                                                                                                                                    echo $_POST['dimensiones'];
                                                                                                                                                                }
                                                                                                                                                            }  ?>">

                            </div>
                            <span class="text-danger"><small><?php echo $errorDimensiones; ?></small></span>
                        </div>

                        <div class="row g-3 align-items-center">
                            <div class="col-3">
                                <label for="" class="col-form-label">
                                    <h5>Materiales</h5>
                                </label>
                            </div>
                            <div class="col-auto">
                                <input type="text" name="materiales" id="materiales" class="form-control" aria-describedby="passwordHelpInline" value="<?php if (isset($_GET['action'])) {
                                                                                                                                                            if ($_GET['action'] == "editarObra" && empty($_POST['materiales'])) {

                                                                                                                                                                echo $obraEditar['materiales'];
                                                                                                                                                            } else if (isset($_POST['materiales'])) {

                                                                                                                                                                echo $_POST['materiales'];
                                                                                                                                                            }
                                                                                                                                                        }  ?>">

                            </div>
                            <span class="text-danger"><small><?php echo $errorMateriales; ?></small></span>
                        </div>

                        <div class="row g-3 align-items-center">
                            <div class="col-3">
                                <label for="" class="col-form-label">
                                    <h5>Fecha de inicio</h5>
                                </label>
                            </div>
                            <div class="col-auto">
                                <input type="date" name="fechaInicio" id="fechaInicio" class="form-control" aria-describedby="passwordHelpInline" value=<?php if (isset($_GET['action'])) {
                                                                                                                                                            if ($_GET['action'] == "editarObra" && empty($_POST['fechaInicio'])) {

                                                                                                                                                                echo $obraEditar['fechaInicio'];
                                                                                                                                                            } else if (isset($_POST['fechaInicio'])) {

                                                                                                                                                                echo $_POST['fechaInicio'];
                                                                                                                                                            }
                                                                                                                                                        }  ?>>
                            </div>
                            <span class="text-danger"><small><?php echo $errorFechaInicio; ?></small></span>
                        </div>

                        <div class="row g-3 align-items-center">
                            <div class="col-3">
                                <label for="" class="col-form-label">
                                    <h5>Fecha de fin</h5>
                                </label>
                            </div>
                            <div class="col-auto">
                                <input type="date" name="fechaFin" id="fechaFin" class="form-control" aria-describedby="passwordHelpInline" value=<?php if (isset($_GET['action'])) {
                                                                                                                                                        if ($_GET['action'] == "editarObra" && empty($_POST['fechaFin'])) {

                                                                                                                                                            echo $obraEditar['fechaFin'];
                                                                                                                                                        } else if (isset($_POST['fechaFin'])) {

                                                                                                                                                            echo $_POST['fechaFin'];
                                                                                                                                                        }
                                                                                                                                                    }  ?>>
                            </div>
                            <span class="text-danger"><small><?php echo $errorFechaFin; ?></small></span>
                        </div>

                        <div class="row g-3 align-items-center">
                            <div class="col-3">
                                <label for="" class="col-form-label">
                                    <h5>Tipo de obra</h5>
                                </label>
                            </div>
                            <div class="col-auto">
                                <input type="text" name="tipoObra" id="tipoObra" class="form-control" aria-describedby="passwordHelpInline" value="<?php if (isset($_GET['action'])) {
                                                                                                                                                        if ($_GET['action'] == "editarObra" && empty($_POST['tipoObra'])) {

                                                                                                                                                            echo $obraEditar['tipoObra'];
                                                                                                                                                        } else if (isset($_POST['tipoObra'])) {

                                                                                                                                                            echo $_POST['tipoObra'];
                                                                                                                                                        }
                                                                                                                                                    }  ?>">
                            </div>

                            <span class="text-danger"><small><?php echo $errorTipoObra; ?></small></span>

                        </div>

                        <div class="col-8 col-md-8">
                            <div class="col-3">
                                <label for="" class="col-form-label">
                                    <h5>Imagen de la obra</h5>
                                </label>
                            </div>
                            <input type="file" name="fotoObra" id="fotoObra" class="form-control" aria-label="file example" required>

                        </div>
                        <span class="text-danger"><small><?php echo $errorImagen; ?></small></span>


                        <div class="col-8 col-md-8">
                            <div class="col-3">
                                <label for="" class="col-form-label">
                                    <h5>Descripcion</h5>
                                </label>
                            </div>
                            <textarea class="form-control" name="descripcion" id="descripcionObra" rows="4" cols="10" maxlength="100"><?php if (isset($_GET['action'])) {
                                                                                                                                            if ($_GET['action'] == "editarObra" && empty($_POST['descripcion'])) {

                                                                                                                                                echo $obraEditar['descripcion'];
                                                                                                                                            } else if (isset($_POST['descripcion'])) {

                                                                                                                                                echo $_POST['descripcion'];
                                                                                                                                            }
                                                                                                                                        }  ?></textarea>
                        </div>
                        <p id="caracteres"></p>

                        <div class="col-6 offset-md-4 mt-5 mb-5">
                            <button class="btn btn-secondary" type="submit">Enviar</button>
                        </div>
                    </form>

                </div>

            </div>

        </body>

        </html>

<?php

    endif;
endif;

?>