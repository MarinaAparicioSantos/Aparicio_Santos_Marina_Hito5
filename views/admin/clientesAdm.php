<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>administrar obras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/tipografia.css">
</head>

<body>

    <!-- Menu -->
    <nav class="sticky-top navbar navbar-expand-lg navbar-light bg-secondary">
        <div class="container-fluid">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">

                <?php

                if (isset($_SESSION['tipo'])) :
                    if ($_SESSION['tipo'] == "cliente" || $_SESSION['tipo'] == "artista" || $_SESSION['tipo'] == "admin") :


                ?>
                        <a class="navbar-brand" href="index.php?controller=obras&action=index"><img class="productos" width="75px" height="75px" src="images/logo.jpg" /></a>

                <?php
                    endif;

                endif;


                ?>
            </ul>

            <?php

            if (isset($_SESSION['tipo'])) :

                if ($_SESSION['tipo'] == "admin") :

            ?>

                    <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                        <li class="nav-item">
                            <a class="nav-link active text-white" aria-current="page" href="index.php?controller=obras&action=index">Obras</a>
                        </li>

                    </ul>

                    <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">

                        <li class="nav-item">
                            <a class="nav-link active text-white" aria-current="page" href="index.php?controller=obras&action=adminClientes">Clientes</a>
                        </li>

                    </ul>

                <?php

                endif;
            endif;

            if (isset($_SESSION['tipo'])) :

                ?>

                <form class="d-flex">
                    <a type="button" class="btn btn-danger btn-lg text-white" href="index.php?controller=usuarios&action=closeSession">Cerrar sesión</a>
                </form>

            <?php
            endif;
            ?>

        </div>
    </nav>

    <br>

    <div class="row">

        <div class="col-2 col-sm-2 col-md-2 mt-5 mb-5"></div>

        <div class="col-8 col-sm-8 col-md-8 mt-5 mb-5" style="text-align:center">

            <table class="table table-striped">
                <tbody>

                    <?php

                    //recorre todos los comentarios
                    foreach ($todosComentarios as $todosComentario) :

                        $idComentario = $todosComentario['idComentario'];

                    ?>
                        <tr>
                            <td id='resultado'><?php echo $todosComentario['nombre_usuario'] ?></td>
                            <td><?php echo $todosComentario['comentario'] ?></td>
                            <td><a class="btn btn-danger mt-5 eliminarComentarios" id="<?php echo $idComentario; ?>" name='eliminarComentarios' role="button" href=<?php echo 'index.php?controller=obras&action=borrarComentarios&id=' . $idComentario ?>>Eliminar</a></td>
                        </tr>

                    <?php

                    endforeach;

                    ?>

                </tbody>
            </table>

        </div>
    </div>

    <footer>

        <div class="col-12 col-sm-12 col-md-12 bg-secondary">
            <h5 class="text-center">© 2022 Copyright Marina Aparicio Santos</h5>
        </div>
    </footer>

</body>

</html>