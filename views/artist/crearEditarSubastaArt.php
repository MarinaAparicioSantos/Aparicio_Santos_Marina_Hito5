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
            <title>Crear o editar subasta</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
            <script type="text/javascript" src="assets/javaScript/validacionTextAreaSubasta.js"></script>
            <link rel="stylesheet" href="assets/css/tipografia.css">
        </head>

        <body>

            <div class="row col-12 col-md-12">

                <div class="col-12 col-md-6 mt-5 mb-5 offset-md-4">

                    <form class="row g-3 needs-validation form-register" enctype="multipart/form-data" action=<?php if (isset($_GET['action'])) {
                                                                                                                    if ($_GET['action'] == "crearSubasta") {

                                                                                                                        echo "index.php?controller=obras&action=crearSubasta";
                                                                                                                    } elseif ($_GET['action'] == "editarSubasta") {

                                                                                                                        echo "index.php?controller=obras&action=editarSubasta&id=" . $_GET['id'];
                                                                                                                    }
                                                                                                                } ?> method="POST" novalidate>

                        <a href='<?php

                                    if ($_GET['action'] == "editarSubasta") {

                                        echo 'index.php?controller=obras&action=subastaObra&id=' . $_GET["id"];
                                    } elseif ($_GET['action'] == "crearSubasta") {

                                        echo 'index.php?controller=obras&action=index';
                                    }

                                    ?>' class="btn-flotante btn-white btn-lg">
                            🢀 </a>

                        <?php



                        if ($_GET['action'] == "crearSubasta") :

                        ?>
                            <div class="offset-md-1">
                                <h1><strong>Crear subasta nueva</strong></h1>
                            </div>

                        <?php

                        endif;

                        if ($_GET['action'] == "editarSubasta") :

                        ?>
                            <div class="offset-md-1">
                                <h1>Editar subasta</h1>
                            </div>
                        <?php

                        endif;

                        if (isset($nombresObras[0]['id']) && $_GET['action'] == "crearSubasta" ||  $_GET['action'] == "editarSubasta") :

                        ?>

                            <div class="row g-3 align-items-center">

                                <?php

                                if ($_GET['action'] == "crearSubasta") :

                                ?>

                                    <div class="col-3">

                                        <label for="nombreObra" class="col-form-label">
                                            <h5>Nombre de la obra</h5>
                                        </label>
                                    </div>
                                    <div class="col-auto">
                                        <select name="idObra">
                                            <?php
                                            foreach ($nombresObras as $nombreObra) :
                                            ?>
                                                <option id="nombreObra" class="form-control" value="<?php echo $nombreObra['id'] ?>" aria-describedby="passwordHelpInline"><?php echo $nombreObra['nombreObra'] ?></option>
                                            <?php
                                            endforeach;

                                            ?>
                                        </select>
                                    </div>
                            </div>

                            <div class="row g-3 align-items-center">
                                <div class="col-3">
                                    <label for="precioInicial" class="col-form-label">
                                        <h5>Precio inicial</h5>
                                    </label>
                                </div>
                                <div class="col-auto">
                                    <input type="number" id="precioInicial" name="precioInicial" class="form-control" aria-describedby="passwordHelpInline">
                                </div>

                                <span class="text-danger"><small><?php echo $errorPrecio; ?></small></span>
                            </div>

                            <div class="row g-3 align-items-center">
                                <div class="col-3">
                                    <label for="fechaFin" class="col-form-label">
                                        <h5>Fecha fin</h5>
                                    </label>
                                </div>
                                <div class="col-auto">
                                    <input type="datetime-local" id="fechaFin" name="fechaFin" class="form-control" aria-describedby="passwordHelpInline">

                                </div>

                                <span class="text-danger"><small><?php echo $errorFecha; ?></small></span>
                            </div>

                        <?php

                                endif;

                        ?>

                        <div class="col-8 col-md-8">
                            <div class="col-3">
                                <label for="descripcion" class="col-form-label">
                                    <h5>Descripción</h5>
                                </label>
                            </div>
                            <textarea class="form-control" id="descripcionSubasta" name="descripcion" rows="4" cols="10" maxlength="120"><?php if (isset($_GET['action'])) {
                                                                                                                                                if ($_GET['action'] == "editarSubasta" && empty($_POST['descripcion'])) {

                                                                                                                                                    echo $subasta['descripcion'];
                                                                                                                                                } else if (isset($_POST['descripcion'])) {

                                                                                                                                                    echo $_POST['descripcion'];
                                                                                                                                                }
                                                                                                                                            }  ?></textarea>

                            <p id="caracteresSubasta"></p>

                        </div>

                        <div class="col-6 offset-md-4 mt-5 mb-5">
                            <button class="btn btn-secondary" type="submit">Enviar</button>
                        </div>

                    </form>

                </div>

            </div>

        <?php

                        endif;
                        if (!isset($nombresObras[0]['id']) && $_GET['action'] == "crearSubasta") :

        ?>

            <div>
                <span class="display-6">No puedes crear ninguna subasta porque aun no tienes ninguna obra que se pueda subastar.</span>
            </div>

        <?php

                        endif;

        ?>

        </body>

        </html>

<?php

    endif;
endif;

?>