<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Principal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="assets/jQuery/login.js"></script>
    <link rel="stylesheet" href="assets/css/zoomImageIndex.css">
    <link rel="stylesheet" href="assets/css/opaco.css">
    <link rel="stylesheet" href="assets/css/tipografia.css">

</head>

<body>

    <!-- Menu -->
    <nav class="sticky-top navbar navbar-expand-lg navbar-light bg-secondary">
        <div class="container-fluid">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">

                <?php

                if (isset($_SESSION['tipo'])) :
                    if ($_SESSION['tipo'] == "cliente" || $_SESSION['tipo'] == "artista" ||$_SESSION['tipo'] == "admin") :


                ?>
                        <a class="navbar-brand" href="index.php?controller=obras&action=index"><img class="productos" width="75px" height="75px" src="images/logo.jpg" /></a>

                    <?php
                    endif;

                endif;

                if (!isset($_SESSION['tipo'])) :

                    ?>

                    <a class="navbar-brand" href="index.php?controller=usuarios&action=login"><img class="productos" width="75px" height="75px" src="images/logo.jpg" />
                    </a>

                <?php

                endif;

                ?>
            </ul>

            <?php

            if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] == "cliente") :

            ?>

                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                    <li class="nav-item">
                        <a class="nav-link active text-white" aria-current="page" href="index.php?controller=obras&action=autores">Autores</a>
                    </li>

                </ul>



                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">

                    <li class="nav-item">
                        <a class="nav-link active text-white" aria-current="page" href="index.php?controller=obras&action=subastas">Subastas activas</a>
                    </li>

                </ul>

                <?php

            endif;



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

                if ($_SESSION['tipo'] == "cliente") :

                ?>

                    <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">

                        <li class="nav-item">
                            <a class="nav-link active text-white" aria-current="page" href=<?php echo 'index.php?controller=obras&action=perfilCliente&id=' . $_SESSION["dni"] ?>>Perfil</a>
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

            if (!isset($_SESSION['tipo'])) :

            ?>

                <form class="d-flex">
                    <button type="button" class="btn btn-dark btn-lg loginButton">Iniciar sesión</button>

                </form>

            <?php
            endif;
            ?>

        </div>
    </nav>


    <div class="row">

        <!-- Carrusel -->

        <?php

        if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] == "artista" || $_SESSION['tipo'] == "cliente") :

        ?>

            <div class="container col-12 col-sm-12 col-md-6 mt-5 mb-5">
                <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">

                    <div class="carousel-inner">
                        <?php
                        $i = 0;
                        //recorre las obras
                        foreach ($obras as $obraArt) :

                            if ($i == 0) :
                        ?>
                                <div class="carousel-item active">

                                <?php endif;
                            if ($i > 0) :

                                ?>

                                    <div class="carousel-item">

                                    <?php

                                endif;

                                $verificar = false;

                                    ?>

                                    <div class="container">
                                        <img src="images\<?php echo $obraArt['fotoObra'] ?>" class="d-block w-100 rounded-3" width="500px" height="500px">
                                        <div class="carousel-caption text-start bg-light rounded-3 opaco">
                                            <h1 class="text-dark" style="text-align:center"><?php echo $obraArt['nombreObra'] ?></h1>
                                            <p class="text-dark" style="text-align:center"><?php echo $obraArt['nombreArtistico'] ?></p>

                                        </div>
                                    </div>
                                    </div>

                                <?php

                                $i++;
                            endforeach;
                                ?>

                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                    </div>
                </div>




                <!-- <div class="col-3 col-sm-3 col-md-9"></div> -->
                <div class="col-3 col-sm-3 col-md-3 login" style="display: none;">

                    <div class="col-12 col-sm-12 col-md-4 mt-5 mb-5">

                        <div class="mx-auto bg-secondary card" style="text-align: center; width: 18rem;">

                            <div class="card-body">
                                <form class="row g-3 needs-validation" method="POST" action="index.php?controller=usuarios&action=login">

                                    <h3>Inicio de sesión</h3>

                                    <div class="row g-3 align-items-center">
                                        <div class="col-auto">
                                            <label for="" class="col-form-label">Nombre de usuario</label>
                                        </div>
                                        <div class="col-auto">
                                            <input name="user" type="text" class="form-control" aria-describedby="passwordHelpInline">
                                        </div>
                                    </div>

                                    <div class="row g-3 align-items-center">
                                        <div class="col-auto">
                                            <label for="" class="col-form-label">Contraseña</label>
                                        </div>
                                        <div class="col-auto">
                                            <input name="pass" type="password" class="form-control" aria-describedby="passwordHelpInline">
                                        </div>
                                    </div>

                                    <input class="btn btn-dark" type="submit" role="button"></input>
                                    <span><?php echo $error, $usuarioError; ?></span>
                                </form>

                                <a class="" href="index.php?controller=usuarios&action=createUser">
                                    <p class="text-dark">¿No tienes cuenta?</p>
                                    <p class="text-dark">Regístrate aquí.</p>
                                </a>

                            </div>
                        </div>

                    </div>


                </div>
            </div>

    </div>

<?php

        endif;

?>

<!-- Catalogo -->

<div class="row">

    <?php

//recorre las obras
    foreach ($obras as $obra) :

        $idObra = $obra["id"];

    ?>
        <div class="col-12 col-sm-12 col-md-4 mt-5 mb-5">

            <div class="mx-auto bg-secondary card" style="text-align: center; width: 18rem; height:25rem">

                <div class="card-body">
                    <img class="imagenObra" width="200px" height="200px" src="images/<?php echo $obra['fotoObra'] ?>" />

                    <div style="height:80px">

                        <h5 class="nombreObra mt-3"><?php echo $obra['nombreObra'] ?></h5>

                        <h5>
                            <div class="nombreArtistico mt-3"><?php echo $obra['nombreArtistico'] ?></div>
                        </h5>

                    </div>

                    <div class="col-12 col-sm-12 col-md-12">

                        <?php


                        if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] == "cliente" || $_SESSION['tipo'] == "artista") :

                        ?> 
                        
                        <a class="btn btn-dark mt-4" href=<?php echo 'index.php?controller=obras&action=detallesObra&id=' . $idObra ?> role="button">Detalles</a>

                        <?php

                        endif;

                        if (isset($_SESSION['tipo']) && $_SESSION['tipo'] == "admin") :

                        ?>
                            <a class="btn btn-danger eliminarObra mt-4" id="<?php echo $obra["id"]; ?>" href=<?php echo 'index.php?controller=obras&action=eliminarObra&id=' . $idObra ?> name='eliminarObra' role="button">Eliminar</a>
                        <?php

                        endif;

                        ?>
                    </div>
                </div>
            </div>

        </div>

    <?php

    endforeach;

    ?>

</div>

<footer>
    <div class="col-12 col-sm-12 col-md-12 bg-secondary">
        <h5 class="text-center">© 2022 Copyright Marina Aparicio Santos</h5>
    </div>
</footer>

</body>

</html>