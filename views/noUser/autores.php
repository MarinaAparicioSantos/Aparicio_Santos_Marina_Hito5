 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Autores</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <link rel="stylesheet" href="assets/css/tipografia.css">
 </head>

 <body>

     <!-- Menu -->

     <nav class="sticky-top navbar navbar-expand-lg navbar-light bg-secondary">
        <div class="container-fluid">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">

                <?php

                if (isset($_SESSION['tipo'])) :
                    if ($_SESSION['tipo'] == "cliente") :


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

                ?>

                <form class="d-flex">
                    <a type="button" class="btn btn-danger btn-lg text-white" href="index.php?controller=usuarios&action=closeSession">Cerrar sesión</a>
                </form>

            <?php
            endif;

            ?>

        </div>
    </nav>

     <!-- autores -->
     <?php

        if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] == "cliente") :

        ?>

         <div class="row mt-5 mb-5">

             <?php

                foreach ($autores as $autor) :

                    $idAutor = $autor["dni"];

                ?>

                 <div class="col-12 col-sm-12 col-md-6 mt-5 mb-5">

                     <div class="mx-auto bg-secondary card" style="text-align: center; width: 25rem; height: 15rem;">

                         <div class="card-body">

                             <div class="row g-3 align-items-center">
                                 <div class="col-5 col-sm-5 col-md-5">
                                     <img class="fotoAutor" width="100px" height="100px" src="images/<?php echo $autor['fotoPerfil'] ?>" />
                                 </div>

                                 <div class="col-7 col-sm-7 col-md-7">
                                     <h5 class="mt-3"><?php echo $autor['nombreArtistico'] ?></h5>
                                     <h5 class="mt-3"><?php echo $autor['redSocial'] ?></h5>
                                     <a class="btn btn-dark mt-5" href=<?php echo 'index.php?controller=obras&action=perfilAutor&id=' . $idAutor ?> role="button">Detalles</a>
                                 </div>
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
                 <h5 class="mt-4 text-center">© 2022 Copyright Marina Aparicio Santos</h5>
             </div>
         </footer>

 </body>

 </html>

 <?php

        endif;

    ?>