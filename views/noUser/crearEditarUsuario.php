<?php

if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] == "cliente" || $_SESSION['tipo'] == "artista") :

?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Crear o editar usuario</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript" src="assets/jQuery/clienteArtista.js"></script>
        <script type="text/javascript" src="assets/javaScript/validacionTextAreaTecnicas.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript" src="assets/javaScript/validacionTextAreaPresentacion.js"></script>
        <link rel="stylesheet" href="assets/css/tipografia.css">
    </head>

    <body>
        <form class="row g-3 needs-validation form-register" enctype="multipart/form-data" action=<?php if (isset($_GET['action'])) {
                                                                                                        if ($_GET['action'] == "createUser") {

                                                                                                            echo "index.php?controller=usuarios&action=createUser";
                                                                                                        } elseif ($_GET['action'] == "editarPerfilCliente") {

                                                                                                            echo "index.php?controller=usuarios&action=editarPerfilCliente&id=" . $_SESSION['dni'];
                                                                                                        } elseif ($_GET['action'] == "editarPerfilAutor") {

                                                                                                            echo "index.php?controller=usuarios&action=editarPerfilAutor&id=" . $_SESSION['dni'];
                                                                                                        }
                                                                                                    } ?> method="POST" novalidate>

            <a href='<?php if (isset($_SESSION['tipo'])) {

                            if ($_SESSION['tipo'] == "cliente") {

                                echo 'index.php?controller=obras&action=perfilCliente&id=' . $_SESSION["dni"];
                            } elseif ($_SESSION['tipo'] == "artista") {

                                echo 'index.php?controller=obras&action=perfilAutor&id=' . $_SESSION["dni"];
                            }
                        } else {

                            echo 'index.php?controller=usuarios&action=login';
                        }

                        ?>' class="btn-flotante btn-white btn-lg">
                🢀 </a>

            <div class="row col-12 col-md-12">

                <div class="col-3 col-sm-3 col-md-4"></div>

                <?php

                if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] == "cliente") :

                ?>
                    <div class="col-12 col-sm-12 col-md-6 ajustarCliente" style="display:none;"></div>

                    <?php

                endif;

                if (isset($_SESSION['tipo'])) :
                    if ($_SESSION['tipo'] == "artista") :

                    ?>

                        <div class="col-12 col-sm-12 col-md-6 "></div>

                <?php

                    endif;
                endif;

                ?>

                <div class="col-12 col-sm-12 col-md-5 mt-5 mb-5 offset-md-1">

                    <div class="row g-3">

                        <?php

                        if (isset($_SESSION['tipo'])) :
                            if ($_SESSION['tipo'] == "artista" || $_SESSION['tipo'] == "cliente") :
                        ?>

                                <h1>Editar perfil</h1>

                            <?php

                            endif;
                        endif;

                        if (!isset($_SESSION['tipo'])) :
                            ?>

                            <h1>Crear usuario</h1>

                        <?php
                        endif;
                        ?>

                        <?php if (isset($_GET['action'])) :
                            if ($_GET['action'] == "createUser") :

                        ?>

                                <div class="row g-3 align-items-center">
                                    <div class="col-3">
                                        <label for="dni" class="col-form-label">
                                            <h5>DNI</h5>
                                        </label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="text" name="dni" id="dni" class="form-control" aria-describedby="passwordHelpInline" value="<?php if (isset($_POST['dni'])) {

                                                                                                                                                        echo $_POST['dni'];
                                                                                                                                                    } ?>">
                                    </div>
                                    <span class="text-danger"><small><?php echo $errorDni; ?></small></span>
                                </div>


                                <div class="row g-3 align-items-center">
                                    <div class="col-3">
                                        <label for="nombreUsuario" class="col-form-label">
                                            <h5>Nombre de usuario</h5>
                                        </label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="text" name="nombreUsuario" id="nombreUsuario" class="form-control" aria-describedby="passwordHelpInline" value="<?php if (isset($_GET['action'])) {
                                                                                                                                                                            if (isset($_POST['nombreUsuario'])) {

                                                                                                                                                                                echo $_POST['nombreUsuario'];
                                                                                                                                                                            }
                                                                                                                                                                        } ?>">
                                    </div>

                                    <span class="text-danger"><small><?php echo $errorNombreUsuario; ?></small></span>
                                </div>

                            <?php

                            endif;
                        endif;

                        if (!isset($_SESSION['tipo'])) :

                            ?>

                            <div class="row g-3 align-items-center">
                                <div class="col-3">
                                    <label for="contrasenya" class="col-form-label">
                                        <h5>Contraseña</h5>
                                    </label>
                                </div>
                                <div class="col-auto">
                                    <input type="password" name="contrasenya" id="contrasenya" class="form-control" aria-describedby="passwordHelpInline">
                                </div>
                                <span class="text-danger"><small><?php echo $errorContrasenya; ?></small></span>

                            </div>

                            <div class="row g-3 align-items-center">
                                <div class="col-3">
                                    <label for="contrasenyaValidar" class="col-form-label">
                                        <h5>Vuelva a escribir la contraseña</h5>
                                    </label>
                                </div>
                                <div class="col-auto">
                                    <input type="password" name="contrasenyaValidar" id="contrasenyaValidar" class="form-control" aria-describedby="passwordHelpInline">
                                </div>
                                <span class="text-danger"><small><?php echo $errorContrasenyaValidar; ?></small></span>

                            </div>

                        <?php

                        endif;

                        ?>

                        <div class="row g-3 align-items-center">
                            <div class="col-3">
                                <label for="nombre" class="col-form-label">
                                    <h5>Nombre propio</h5>
                                </label>
                            </div>
                            <div class="col-auto">
                                <input type="text" name="nombre" id="nombre" class="form-control" aria-describedby="passwordHelpInline" value="<?php if (isset($_GET['action'])) {
                                                                                                                                                    if ($_GET['action'] == "editarPerfilCliente" && empty($_POST['nombre'])) {

                                                                                                                                                        echo $cliente['nombre'];
                                                                                                                                                    } else if ($_GET['action'] == "editarPerfilAutor" && empty($_POST['nombre'])) {

                                                                                                                                                        echo $autor['nombre'];
                                                                                                                                                    } else if (isset($_POST['nombre'])) {

                                                                                                                                                        echo $_POST['nombre'];
                                                                                                                                                    }
                                                                                                                                                } ?>">
                            </div>
                            <span class="text-danger"><small><?php echo $errorNombrePropio; ?></small></span>
                        </div>

                        <div class="row g-3 align-items-center">
                            <div class="col-3">
                                <label for="apellido1" class="col-form-label">
                                    <h5>Apellido 1</h5>
                                </label>
                            </div>
                            <div class="col-auto">
                                <input type="text" name="apellido1" id="apellido1" class="form-control" aria-describedby="passwordHelpInline" value="<?php if (isset($_GET['action'])) {
                                                                                                                                                            if ($_GET['action'] == "editarPerfilCliente" && empty($_POST['apellido1'])) {

                                                                                                                                                                echo $cliente['apellido1'];
                                                                                                                                                            } else if ($_GET['action'] == "editarPerfilAutor" && empty($_POST['apellido1'])) {

                                                                                                                                                                echo $autor['apellido1'];
                                                                                                                                                            } else if (isset($_POST['apellido1'])) {

                                                                                                                                                                echo $_POST['apellido1'];
                                                                                                                                                            }
                                                                                                                                                        } ?>">
                            </div>
                            <span class="text-danger"><small><?php echo $errorApellidoUno; ?></small></span>
                        </div>

                        <div class="row g-3 align-items-center">
                            <div class="col-3">
                                <label for="apellido2" class="col-form-label">
                                    <h5>Apellido 2</h5>
                                </label>
                            </div>
                            <div class="col-auto">
                                <input type="text" name="apellido2" id="apellido2" class="form-control" aria-describedby="passwordHelpInline" value="<?php if (isset($_GET['action'])) {
                                                                                                                                                            if ($_GET['action'] == "editarPerfilCliente" && empty($_POST['apellido2'])) {

                                                                                                                                                                echo $cliente['apellido2'];
                                                                                                                                                            } else if ($_GET['action'] == "editarPerfilAutor" && empty($_POST['apellido2'])) {

                                                                                                                                                                echo $autor['apellido2'];
                                                                                                                                                            } else if (isset($_POST['apellido2'])) {

                                                                                                                                                                echo $_POST['apellido2'];
                                                                                                                                                            }
                                                                                                                                                        } ?>">
                            </div>
                            <span class="text-danger"><small><?php echo $errorApellidoDos; ?></small></span>
                        </div>


                        <div class="row g-3 align-items-center">
                            <div class="col-3">
                                <label for="correo" class="col-form-label">
                                    <h5>Correo</h5>
                                </label>
                            </div>
                            <div class="col-auto">
                                <input type="text" name="correo" id="correo" class="form-control" aria-describedby="passwordHelpInline" value="<?php if (isset($_GET['action'])) {
                                                                                                                                                    if ($_GET['action'] == "editarPerfilCliente" && empty($_POST['correo'])) {

                                                                                                                                                        echo $cliente['correo'];
                                                                                                                                                    } else if ($_GET['action'] == "editarPerfilAutor" && empty($_POST['correo'])) {

                                                                                                                                                        echo $autor['correo'];
                                                                                                                                                    } else if (isset($_POST['correo'])) {

                                                                                                                                                        echo $_POST['correo'];
                                                                                                                                                    }
                                                                                                                                                } ?>">
                            </div>
                            <span class="text-danger"><small><?php echo $errorCorreo; ?></small></span>
                        </div>


                        <div class="col-8 col-md-8">
                            <div class="col-3">
                                <label for="fotoPerfil" class="col-form-label">
                                    <h5>Imagen de perfil</h5>
                                </label>
                            </div>
                            <input type="file" name="fotoPerfil" id="fotoPerfil" class="form-control" aria-label="file example" required value="<?php if (isset($_GET['action'])) {
                                                                                                                                                    if ($_GET['action'] == "editarPerfilCliente" && empty($_POST['fotoPerfil'])) {

                                                                                                                                                        echo $cliente['fotoPerfil'];
                                                                                                                                                    } else if ($_GET['action'] == "editarPerfilAutor" && empty($_POST['fotoPerfil'])) {

                                                                                                                                                        echo $autor['fotoPerfil'];
                                                                                                                                                    } else if (isset($_POST['fotoPerfil'])) {

                                                                                                                                                        echo $_POST['fotoPerfil'];
                                                                                                                                                    }
                                                                                                                                                } ?>">
                        </div>


                        <div class="col-8 col-md-8">
                            <div class="col-3">
                                <label for="presentacion" class="col-form-label">
                                    <h5>Presentación</h5>
                                </label>
                            </div>
                            <textarea class="form-control" name="presentacion" id="presentacion" rows="4" cols="10" maxlength="100"><?php if (isset($_GET['action'])) {
                                                                                                                                        if ($_GET['action'] == "editarPerfilCliente" && empty($_POST['presentacion'])) {

                                                                                                                                            echo $cliente['presentacion'];
                                                                                                                                        } else if ($_GET['action'] == "editarPerfilAutor" && empty($_POST['presentacion'])) {

                                                                                                                                            echo $autor['presentacion'];
                                                                                                                                        } else if (isset($_POST['presentacion'])) {

                                                                                                                                            echo $_POST['presentacion'];
                                                                                                                                        }
                                                                                                                                    } ?></textarea>

                            <p id="caracteresPresentacion"></p>
                        </div>

                        <?php

                        if (isset($_SESSION['tipo'])) :
                            if ($_SESSION['tipo'] == "artista" || $_SESSION['tipo'] == "cliente") :

                        ?>

                                <div class="col-6 col-md-6 offset-md-2">
                                    <a type="button" class="btn btn-dark btn-lg" href="index.php?controller=usuarios&action=cambiarContrasenya">Cambiar contraseña</a>
                                </div>
                            <?php

                            endif;
                        endif;

                        if (!isset($_SESSION['tipo'])) :

                            ?>

                            <div class="col-6 col-md-6">
                                <select class="form-select" size="2" name="clienteArtista" id="clienteArtista">
                                    <option class="cliente" value="cliente" selected>Cliente</option>
                                    <option class="artista" value="artista">Artista</option>
                                </select>
                            </div>


                        <?php

                        endif;

                        ?>

                    </div>

                </div>

                <div class="col-3 col-sm-3 col-md-1"></div>

                <?php

                if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] == "cliente") :

                ?>
                    <div class="col-12 col-sm-12 col-md-3 mt-5 mb-5 artistaMostrar" style="display:none;">

                        <?php

                    endif;

                    if (isset($_SESSION['tipo'])) :
                        if ($_SESSION['tipo'] == "artista") :

                        ?>

                            <div class="col-12 col-sm-12 col-md-3 mt-5 mb-5 ">

                        <?php

                        endif;
                    endif;

                        ?>

                        <div class="row g-3">

                            <h1>Datos de artista</h1>

                            <div class="row g-3 align-items-center">
                                <div class="col-3">
                                    <label for="nombreArtistico" class="col-form-label">
                                        <h5>Nombre artístico</h5>
                                    </label>
                                </div>
                                <div class="col-auto">
                                    <input type="text" name="nombreArtistico" id="nombreArtistico" class="form-control" aria-describedby="passwordHelpInline" value="<?php if (isset($_GET['action'])) {
                                                                                                                                                                            if ($_GET['action'] == "editarPerfilAutor" && empty($_POST['nombreArtistico'])) {

                                                                                                                                                                                echo $autor['nombreArtistico'];
                                                                                                                                                                            } else if (isset($_POST['nombreArtistico'])) {

                                                                                                                                                                                echo $_POST['nombreArtistico'];
                                                                                                                                                                            }
                                                                                                                                                                        } ?>">
                                </div>
                                <span class="text-danger"><small><?php echo $errorNombreArtistico; ?></small></span>
                            </div>

                            <div class="col-8 col-md-8 align-items-center">
                                <div class="col-3">
                                    <label for="tecnicas" class="col-form-label">
                                        <h5>Técnicas</h5>
                                    </label>
                                </div>
                                <textarea class="form-control" name="tecnicas" id="tecnicas" rows="6" cols="5" maxlength="100"><?php if (isset($_GET['action'])) {
                                                                                                                                    if ($_GET['action'] == "editarPerfilAutor" && empty($_POST['tecnicas'])) {

                                                                                                                                        echo $autor['tecnicas'];
                                                                                                                                    } else if (isset($_POST['tecnicas'])) {

                                                                                                                                        echo $_POST['tecnicas'];
                                                                                                                                    }
                                                                                                                                } ?></textarea>
                                <p id="caracteresTecnicas"></p>
                            </div>

                            <div class="row g-3 align-items-center">
                                <div class="col-3">
                                    <label for="redSocial" class="col-form-label">
                                        <h5>Red social</h5>
                                    </label>
                                </div>
                                <div class="col-auto">
                                    <input type="text" name="redSocial" id="redSocial" class="form-control" aria-describedby="passwordHelpInline" value="<?php if (isset($_GET['action'])) {
                                                                                                                                                                if ($_GET['action'] == "editarPerfilAutor" && empty($_POST['redSocial'])) {

                                                                                                                                                                    echo $autor['redSocial'];
                                                                                                                                                                } else if (isset($_POST['redSocial'])) {

                                                                                                                                                                    echo $_POST['redSocial'];
                                                                                                                                                                }
                                                                                                                                                            } ?>">
                                </div>
                                <span class="text-danger"><small><?php echo $errorRedSocial; ?></small></span>
                            </div>

                            <div class="row g-3 align-items-center">
                                <div class="col-3">
                                    <label for="fechaComienzo" class="col-form-label">
                                        <h5>Fecha de comienzo</h5>
                                    </label>
                                </div>
                                <div class="col-auto">
                                    <input type="date" name="fechaComienzo" id="fechaComienzo" class="form-control" aria-describedby="passwordHelpInline" value="<?php if (isset($_GET['action'])) {
                                                                                                                                                                        if ($_GET['action'] == "editarPerfilAutor" && empty($_POST['fechaComienzo'])) {

                                                                                                                                                                            echo $autor['fechaComienzo'];
                                                                                                                                                                        } else if (isset($_POST['fechaComienzo'])) {

                                                                                                                                                                            echo $_POST['fechaComienzo'];
                                                                                                                                                                        }
                                                                                                                                                                    } ?>">
                                </div>
                                <span class="text-danger"><small><?php echo $errorFechaComienzo; ?></small></span>
                            </div>



                        </div>

                            </div>

                    </div>
                    <div class="col-6 offset-md-6 mt-5 mb-5">
                        <button class="btn btn-secondary" type="submit">Enviar</button>
                    </div>
        </form>

    </body>

    </html>

<?php

endif;

?>