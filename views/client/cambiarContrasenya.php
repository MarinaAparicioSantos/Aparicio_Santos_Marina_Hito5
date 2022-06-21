<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambio contraseña</title>
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

            <form class="row g-3 needs-validation form-register" enctype="multipart/form-data" action="index.php?controller=usuarios&action=cambiarContrasenya" method="POST" novalidate>

                <a href='<?php if (isset($_SESSION['tipo'])) {
                                if ($_SESSION['tipo'] == "cliente") {

                                    echo "index.php?controller=usuarios&action=editarPerfilCliente&id=" . $_SESSION['dni'];
                                } elseif ($_SESSION['tipo'] == "artista") {

                                    echo "index.php?controller=usuarios&action=editarPerfilAutor&id=" . $_SESSION['dni'];
                                }
                            }

                            ?>' class="btn-flotante btn-white btn-lg">
                    🢀 </a>



                <div class="offset-md-1">
                    <h1>Cambiar contraseña</h1>
                </div>


                <div class="row g-3 align-items-center">
                    <div class="col-3">
                        <label for="contrasenya" class="col-form-label">
                            <h5>Escriba su contraseña</h5>
                        </label>
                    </div>
                    <div class="col-auto">
                        <input type="password" name="contrasenyaUsuario" id="contrasenya" class="form-control" aria-describedby="passwordHelpInline">
                    </div>
                    <span class="text-danger"><small><?php echo $contrasenyaError; ?></small></span>

                </div>


                <div class="row g-3 align-items-center">
                    <div class="col-3">
                        <label for="contrasenya" class="col-form-label">
                            <h5>Contraseña</h5>
                        </label>
                    </div>
                    <div class="col-auto">
                        <input type="password" name="contrasenya" id="contrasenya" class="form-control" aria-describedby="passwordHelpInline">
                    </div>

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
                    <span class="text-danger"><small><?php echo $error, $contrasenyaErrorValidar; ?></small></span>

                </div>


                <div class="col-6 offset-md-4 mt-5 mb-5 offset-md-1">
                    <button class="btn btn-secondary" type="submit">Enviar</button>
                </div>


            </form>

        </div>

    </div>

    </div>



</body>

</html>