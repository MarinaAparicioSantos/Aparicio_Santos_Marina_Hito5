<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Obras artista</title>
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
                    if ($_SESSION['tipo'] == "artista") :


                ?>
                        <a class="navbar-brand" href="index.php?controller=obras&action=index"><img class="productos" width="75px" height="75px" src="images/logo.jpg" /></a>

                    <?php
                    endif;

                endif;

                ?>
            </ul>

            <?php

            if (isset($_SESSION['tipo'])) :

                if ($_SESSION['tipo'] == "artista") :

                ?>


                    <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">

                        <li class="nav-item">
                            <a class="nav-link active text-white" aria-current="page" href='index.php?controller=obras&action=misSubastas'>Mis subastas</a>
                        </li>

                    </ul>

                    <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">

                        <li class="nav-item">
                            <a class="nav-link active text-white" aria-current="page" href='index.php?controller=obras&action=misObras'>Mis obras</a>
                        </li>

                    </ul>


                    <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">

                        <li class="nav-item">
                            <a class="nav-link active text-white" aria-current="page" href='index.php?controller=obras&action=clientes'>Clientes</a>
                        </li>

                    </ul>


                <?php
                endif;

            endif;


            if (isset($_SESSION['tipo'])) :

                if ($_SESSION['tipo'] == "artista") :

                ?>

                    <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">

                        <li class="nav-item">
                            <a class="nav-link active text-white" aria-current="page" href=<?php echo 'index.php?controller=obras&action=perfilAutor&id=' . $_SESSION["dni"] ?>>Perfil</a>
                        </li>

                    </ul>

                <?php
                endif;

            endif;

            if (isset($_SESSION['tipo'])) :

                if ($_SESSION['tipo'] == "artista") :

                ?>

                    <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">

                        <li class="nav-item">
                            <a class="nav-link active text-white" aria-current="page" href="index.php?controller=obras&action=crearObra">Crear obra</a>
                        </li>

                    </ul>

                    <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">

                        <li class="nav-item">
                            <a class="nav-link active text-white" aria-current="page" href="index.php?controller=obras&action=crearSubasta">Crear subasta</a>
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


    <?php

    if (isset($_SESSION['tipo'])) :

        if ($_SESSION['tipo'] == "artista") :

            if (isset($obras[0]["idObra"])) :

    ?>

                <div class="row mt-5 mb-5">

                    <?php

                    foreach ($obras as $obra) :

                        $idObraPropia = $obra["idObra"];

                    ?>

                        <div class="col-12 col-sm-12 col-md-6 mt-5 mb-5">

                            <div class="row g-3">
                                <div class="mx-auto bg-secondary card" style="text-align: center; width: 21rem; height: 23rem;">
                                    <div class="card-body">
                                        <div class="col-12 col-sm-12 col-md-12">
                                            <img class="fotoObra" width="100px" height="100px" src="images/<?php echo $obra['fotoObra'] ?>" />
                                            <h5 class="nombreObra mt-3"><?php echo $obra['nombreObra'] ?></h5>
                                        </div>

                                        <div class="col-12 col-sm-12 col-md-12">
                                            <a class="btn btn-dark mt-5" href=<?php echo 'index.php?controller=obras&action=detallesObra&id=' . $idObraPropia ?> role="button">Detalles</a>

                                            <a class="btn btn-dark mt-5" href=<?php echo 'index.php?controller=obras&action=editarObra&id=' . $idObraPropia ?> role="button">Editar</a>

                                        </div>

                                        <div class="col-12 col-sm-12 col-md-12">

                                            <a class="btn btn-danger mt-5" href="<?php echo 'index.php?controller=obras&action=borrarObraArtista&id=' . $idObraPropia ?>" role="button">Eliminar</a>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    <?php

                    endforeach;

                    ?>

                </div>

            <?php
            endif;

            if (!isset($obras[0]["idObra"])) :

            ?>

                <div class="text-center display-6">
                    <span> Aun no tienes ninguna obra.</span>
                </div>

            <?php

            endif; ?>


            <footer>

                <div class="col-12 col-sm-12 col-md-12 bg-secondary">
                    <h5 class="text-center">© 2022 Copyright Marina Aparicio Santos</h5>
                </div>
            </footer>

</body>

</html>

<?php

        endif;

    endif;

?>