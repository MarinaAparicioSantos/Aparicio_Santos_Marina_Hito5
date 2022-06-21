<?php

/**
 * @author Marina Aparicio Santos
 */

session_start();


/**
 * login realiza el inicio de sesión
 *
 * @return void
 */
function login()
{
  require_once './models/usuariosModel.php';

  $contrasenya = "";
  $usuario = "";
  $error = "";
  $usuarioError = "";

  if (empty($_SESSION["tipo"])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

      function asegurar($valor)
      {
        $valor = strip_tags($valor);
        $valor = stripslashes($valor);
        $valor = htmlspecialchars($valor);
        return $valor;
      }

      $usuario = $_POST["user"];
      $contrasenya = $_POST["pass"];

      $getUsuario = usuario(asegurar($usuario));

      if ($getUsuario) {

        //verifica la contraseña
        if (password_verify(asegurar($contrasenya), $getUsuario["contrasenya"])) {

          //crea la sesion dni
          $dni = $getUsuario["dni"];
          $_SESSION["dni"] = $dni;
          $tipo = tipoUsuario($dni);

          //crea la sesion tipo
          if (isset($tipo)) {
            $_SESSION["tipo"] = $tipo["tipo"];
          }

          header("Location: index.php?controller=obras&action=index");
        } else {

          $error = "contraseña incorrecta";
        }
      } else {

        $usuarioError = "Usuario y contraseña incorrectas";
      }
    }
  } else if (!empty($_SESSION["tipo"])) {
    header("Location: index.php?controller=obras&action=index");
  } else {
    session_destroy();
  }

  $obras = mostrarObras();

  include "./views/noUser/principal.php";
}


/**
 * closeSession cierra la sesion
 *
 * @return void
 */
function closeSession()
{
  session_start();
  session_destroy();
  header("Location: index.php?controller=usuarios&action=login");
}


/**
 * createUser crea un nuevo usuario
 *
 * @return void
 */
function createUser()
{

  function asegurar($valor)
  {
    $valor = strip_tags($valor);
    $valor = stripslashes($valor);
    $valor = htmlspecialchars($valor);
    return $valor;
  }

  require_once './models/obrasModel.php';

  $dni = "";
  $nombreUsuario = "";
  $contrasenya = "";
  $tipo = "";
  $nombre = "";
  $apellidoUno = "";
  $apellidoDos = "";
  $fotoPerfil = "";
  $presentacion = "";
  $correo = "";

  $errorDni = "";
  $errorNombreUsuario = "";
  $errorContrasenya = "";
  $errorContrasenyaValidar = "";
  $errorNombrePropio = "";
  $errorApellidoUno = "";
  $errorApellidoDos = "";
  $errorCorreo = "";

  $dniArtista = "";
  $nombreArtistico = "";
  $fechaComienzo = "";
  $tecnicas = "";
  $redSocial = "";

  $errorNombreArtistico = "";
  $errorRedSocial = "";
  $errorFechaComienzo = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $dni = $_POST["dni"];
    $nombreUsuario = $_POST["nombreUsuario"];
    $contrasenya =  password_hash($_POST["contrasenya"], PASSWORD_DEFAULT);
    $tipo = $_POST["clienteArtista"];
    $nombre = $_POST["nombre"];
    $apellidoUno = $_POST["apellido1"];
    $apellidoDos = $_POST["apellido2"];
    $presentacion = $_POST["presentacion"];
    $correo = $_POST["correo"];


    $target_dir = "./images/";
    $target_file = $target_dir . basename($_FILES["fotoPerfil"]["name"]);
    $fotoPerfil = $_FILES["fotoPerfil"]["name"];
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


    $validarUsuario = true;

    //valida los campos de cliente

    if (empty($dni)) {

      $errorDni = "Error, el DNI es obligatorio.";
      $validarUsuario = false;
    } elseif (!preg_match("/^[0-9]{8}[A-Z]{1}$/", $dni)) {

      $errorDni = "Error, el formato es incorrecto.";
      $validarUsuario = false;
    }

    //comprueba que no exista ese nombre de usuario
    $comprobarUsuario = comprobarUsuario($nombreUsuario);

    if (empty($nombreUsuario)) {

      $errorNombreUsuario = "Error, el nombre de usuario es obligatorio";
      $validarUsuario = false;
    } elseif (!preg_match("/^[0-9 A-z]\S{1,14}$/", $nombreUsuario)) {

      $errorNombreUsuario = "Error, el nombre de usuario no puede tener mas de 15 caracteres ni espacios en blanco. Tiene que contener al menos dos letras";
      $validarUsuario = false;
    } elseif (!empty($comprobarUsuario)) {

      $errorNombreUsuario = "Error, ya existe ese nombre de usuario";
      $validarUsuario = false;
    }


    if (empty($_POST["contrasenya"])) {

      $errorContrasenya = "Error, la contraseña es necesaria.";
      $validarUsuario = false;
    } elseif (!preg_match("/^.\S{3,19}$/", $_POST["contrasenya"])) {

      $errorContrasenya = "Error, la contraseña debe tener entre 4 y 20 caracteres sin espacios.";
      $validarUsuario = false;
    }


    if ($_POST["contrasenya"] != $_POST['contrasenyaValidar']) {

      $errorContrasenyaValidar = "Error, las contraseñas no coinciden.";

      $validarUsuario = false;
    }


    $mayusculas = "/^[A-Z][a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/";

    if (empty($nombre)) {

      $errorNombrePropio = "Error, el nombre es necesario.";
      $validarUsuario = false;
    } elseif (!preg_match($mayusculas, $nombre)) {

      $errorNombrePropio = "Error, el nombre debe ir en mayúsculas";
      $validarUsuario = false;
    }


    if (empty($apellidoUno)) {

      $errorApellidoUno = "Error, el primer apellido es necesario.";
      $validarUsuario = false;
    } elseif (!preg_match($mayusculas, $apellidoUno)) {

      $errorApellidoUno = "Error, el apellido debe ir en mayúsculas";
      $validarUsuario = false;
    }

    if (empty($apellidoDos)) {

      $errorApellidoDos = "Error, el segundo apellido es necesario.";
      $validarUsuario = false;
    } elseif (!preg_match($mayusculas, $apellidoDos)) {

      $errorApellidoDos = "Error, el apellido debe ir en mayúsculas";
      $validarUsuario = false;
    }

    if (empty($correo)) {

      $errorCorreo = "Error, correo es necesario.";
      $validarUsuario = false;
    } elseif (!preg_match("/\w{3,}@{1}\w+\.{1}\w{2,3}$/", $correo)) {

      $errorCorreo = "Error, el correo es incorrecto.";
      $validarUsuario = false;
    }


    if ($uploadOk == 0) {
      $errorImagen = "La imagen no se pudo guardar";
    } else {
      if ($validarUsuario) {
        if (move_uploaded_file($_FILES["fotoPerfil"]["tmp_name"], $target_file)) {


          //crea un cliente
          $insertar = creacionCliente(
            asegurar($dni),
            asegurar($nombreUsuario),
            asegurar($contrasenya),
            asegurar($tipo),
            asegurar($nombre),
            asegurar($apellidoUno),
            asegurar($apellidoDos),
            $fotoPerfil,
            asegurar($presentacion),
            asegurar($correo)
          );
          if (!$insertar) {

            $error = "ERROR";
          } else {


            header("location: index.php?controller=usuarios&action=login");
          }
        } else {
          $errorImagen = "No se ha guardado la imagen de la obra.";
        }
      }
    }

    $validarUsuarioArtista = true;
    if ($_POST["clienteArtista"] == "artista") {

      $dniArtista = $_POST["dni"];
      $nombreArtistico = $_POST["nombreArtistico"];
      $fechaComienzo = $_POST["fechaComienzo"];
      $tecnicas = $_POST["tecnicas"];
      $redSocial = $_POST["redSocial"];

      //valida los campos de artista

      if (empty($nombreArtistico)) {

        $errorNombreArtistico = "Error, hay que indicar el nombre artístico.";
        $validarUsuarioArtista = false;
      } elseif (!preg_match("/^[A-z0-9\s]{1,20}$/", $nombreArtistico)) {

        $errorNombreArtistico = "Error, el nombre artístico no puede tener más de 20 caracteres.";
        $validarUsuarioArtista = false;
      }

      if (isset($redSocial)) {
        if (!preg_match("/^[A-z0-9:\s]{0,20}$/", $redSocial)) {

          $errorRedSocial = "Error, no puede haber mas de 20 caracteres.";
          $validarUsuarioArtista = false;
        }
      }

      date_default_timezone_set('Europe/Madrid');
      $hoy = date('Y-m-d', time());

      $diferenciaFechas = strtotime($fechaComienzo) - strtotime($hoy);

      if ($diferenciaFechas > 0) {

        $errorFechaComienzo = "Error, la fecha no puede ser anterior a la de hoy.";
        $validarUsuarioArtista = false;
      }

      if ($validarUsuario && $validarUsuarioArtista) {

        //inserta los datos de un artista
        $insertarArtista = creacionArtista(
          asegurar($dniArtista),
          asegurar($nombreArtistico),
          asegurar($fechaComienzo),
          asegurar($tecnicas),
          asegurar($redSocial)
        );
        if (!$insertarArtista) {

          $error = "ERROR";
        } else {


          header("location: index.php?controller=usuarios&action=login");
        }
      }
    }
  }
  include "./views/noUser/crearEditarUsuario.php";
}


/**
 * cambiarContrasenya hace que un usuario pueda cambiar su contraseña
 *
 * @return void
 */
function cambiarContrasenya()
{

  require_once './models/usuariosModel.php';

  $error = "";
  $contrasenyaError = "";
  $dni = "";
  $contrasenyaUsuario = "";
  $contrasenya = "";
  $contrasenyaValidar = "";
  $contrasenyaErrorValidar = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    function asegurar($valor)
    {
      $valor = strip_tags($valor);
      $valor = stripslashes($valor);
      $valor = htmlspecialchars($valor);
      return $valor;
    }

    $dni = $_SESSION['dni'];
    $contrasenyaUsuario = $_POST["contrasenyaUsuario"];
    $contrasenya = $_POST["contrasenya"];
    $contrasenyaValidar = $_POST["contrasenyaValidar"];

    $getDni = dniContrasenya($_SESSION['dni']);

    $validar = true;

    if ($getDni) {


      //valida que la contraseña esta correcta
      if (!password_verify(asegurar($contrasenyaUsuario), $getDni["contrasenya"])) {

        $contrasenyaError = "Contraseña incorrecta.";
      } else {


        if (empty($contrasenya)) {

          $error = "Error, la contraseña es necesaria.";
          $validar = false;
        } elseif (!preg_match("/^.\S{3,19}$/", $contrasenya)) {

          $error = "Error, la contraseña debe tener entre 4 y 20 caracteres sin espacios.";
          $validar = false;
        }

        //valida que la nueva contraseña es distinta a la que ya tenia
        if ($contrasenya != $contrasenyaValidar) {

          $contrasenyaErrorValidar = "Error, las contraseñas no coinciden.";

          $validar = false;
        } elseif (password_verify(asegurar($contrasenya), $getDni["contrasenya"])) {

          $contrasenyaErrorValidar = "Error, no puedes poner la misma contraseña que antes.";

          $validar = false;
        }

        if ($validar) {

          //actualiza la contraseña
          $cambiarContrasenya = cambioContrasenya(

            $dni,
            asegurar(password_hash($contrasenya, PASSWORD_DEFAULT))

          );

          if (isset($_SESSION['tipo'])) {

            if ($_SESSION['tipo'] == "artista") {

              header("location: index.php?controller=obras&action=perfilAutor&id=" . $_SESSION['dni']);
            } elseif ($_SESSION['tipo'] == "cliente") {

              header("location: index.php?controller=obras&action=perfilCliente&id=" . $_SESSION['dni']);
            }
          }
        }
      }
    }
  }

  include "./views/client/cambiarContrasenya.php";
}


/**
 * editarPerfilAutor hace que un artista pueda actualizar su perfil
 *
 * @return void
 */
function editarPerfilAutor()
{
  require_once './models/obrasModel.php';

  $autor = mostrarArtistaConcreto($_GET['id']);

  $dni = "";
  $nombre = "";
  $apellidoUno = "";
  $apellidoDos = "";
  $presentacion = "";
  $correo = "";

  $errorNombrePropio = "";
  $errorApellidoUno = "";
  $errorApellidoDos = "";
  $errorCorreo = "";

  $nombreArtistico = "";
  $fechaComienzo = "";
  $tecnicas = "";
  $redSocial = "";

  $errorNombreArtistico = "";
  $errorRedSocial = "";
  $errorFechaComienzo = "";


  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    function asegurar($valor)
    {
      $valor = strip_tags($valor);
      $valor = stripslashes($valor);
      $valor = htmlspecialchars($valor);
      return $valor;
    }

    $dni = $_GET['id'];
    $nombre = $_POST['nombre'];
    $apellidoUno = $_POST['apellido1'];
    $apellidoDos = $_POST['apellido2'];
    $presentacion = $_POST['presentacion'];
    $correo = $_POST['correo'];

    $nombreArtistico = $_POST['nombreArtistico'];
    $fechaComienzo = $_POST['fechaComienzo'];
    $tecnicas = $_POST['tecnicas'];
    $redSocial = $_POST['redSocial'];


    $fotoPerfil = "";
    if ($_FILES["fotoPerfil"]["name"] != '') {
      $fotoPerfil = $_FILES["fotoPerfil"]["name"];
      $temp = $_FILES['fotoPerfil']['tmp_name'];
      if (move_uploaded_file($temp, 'images/' . $fotoPerfil)) {

        chmod('images/' . $fotoPerfil, 0777);
      }
    } else {
      $fotoPerfil = $autor["fotoPerfil"];
    }

    $validarUsuario = true;

    //valida los campos

    $mayusculas = "/^[A-Z][a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/";

    if (empty($nombre)) {

      $errorNombrePropio = "Error, el nombre es necesario.";
      $validarUsuario = false;
    } elseif (!preg_match($mayusculas, $nombre)) {

      $errorNombrePropio = "Error, el nombre debe ir en mayúsculas";
      $validarUsuario = false;
    }


    if (empty($apellidoUno)) {

      $errorApellidoUno = "Error, el primer apellido es necesario.";
      $validarUsuario = false;
    } elseif (!preg_match($mayusculas, $apellidoUno)) {

      $errorApellidoUno = "Error, el apellido debe ir en mayúsculas";
      $validarUsuario = false;
    }

    if (empty($apellidoDos)) {

      $errorApellidoDos = "Error, el segundo apellido es necesario.";
      $validarUsuario = false;
    } elseif (!preg_match($mayusculas, $apellidoDos)) {

      $errorApellidoDos = "Error, el apellido debe ir en mayúsculas";
      $validarUsuario = false;
    }


    if (empty($correo)) {

      $errorCorreo = "Error, correo es necesario.";
      $validarUsuario = false;
    } elseif (!preg_match("/\w{3,}@{1}\w+\.{1}\w{2,3}$/", $correo)) {

      $errorCorreo = "Error, el correo es incorrecto.";
      $validarUsuario = false;
    }


    if (empty($nombreArtistico)) {

      $errorNombreArtistico = "Error, hay que indicar el nombre artístico.";
      $validarUsuario = false;
    } elseif (!preg_match("/^[A-z0-9\s]{1,20}$/", $nombreArtistico)) {

      $errorNombreArtistico = "Error, el nombre artístico no puede tener más de 20 caracteres.";
      $validarUsuario = false;
    }

    if (isset($redSocial)) {
      if (!preg_match("/^[A-z0-9:\s]{0,20}$/", $redSocial)) {

        $errorRedSocial = "Error, no puede haber mas de 20 caracteres.";
        $validarUsuario = false;
      }
    }

    date_default_timezone_set('Europe/Madrid');
    $hoy = date('Y-m-d', time());

    $diferenciaFechas = strtotime($fechaComienzo) - strtotime($hoy);

    if ($diferenciaFechas > 0) {

      $errorFechaComienzo = "Error, la fecha no puede ser anterior a la de hoy.";
      $validarUsuario = false;
    }

    //actualiza un artista, que tiene los datos de cliente y artista
    if ($validarUsuario) {
      $editar = edicionCliente(
        asegurar($dni),
        asegurar($nombre),
        asegurar($apellidoUno),
        asegurar($apellidoDos),
        $fotoPerfil,
        asegurar($presentacion),
        asegurar($correo)
      );

      $editarArtista = edicionArtista(
        asegurar($dni),
        asegurar($nombreArtistico),
        asegurar($fechaComienzo),
        asegurar($tecnicas),
        asegurar($redSocial),
      );


      if ($editar && $editarArtista) {
        header("Location: index.php?controller=obras&action=perfilAutor&id=" . $_SESSION["dni"]);
        var_dump($editar);

        exit();
      } else {
        $error = "Datos incorrectos o no se ha actualizado nada";
        var_dump($editar);
        echo $error;
      }
    }
  }

  include "./views/noUser/crearEditarUsuario.php";
}


/**
 * editarPerfilCliente hace que un cliente pueda editar sus datos
 *
 * @return void
 */
function editarPerfilCliente()
{

  require_once './models/obrasModel.php';
  $cliente = mostrarClienteConcreto($_GET['id']);

  $dni = "";
  $nombre = "";
  $apellidoUno = "";
  $apellidoDos = "";
  $presentacion = "";
  $correo = "";

  $errorDni = "";
  $errorNombreUsuario = "";
  $errorContrasenya = "";
  $errorContrasenyaValidar = "";
  $errorNombrePropio = "";
  $errorApellidoUno = "";
  $errorApellidoDos = "";
  $errorCorreo = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    function asegurar($valor)
    {
      $valor = strip_tags($valor);
      $valor = stripslashes($valor);
      $valor = htmlspecialchars($valor);
      return $valor;
    }

    $dni = $_GET['id'];
    $nombre = $_POST['nombre'];
    $apellidoUno = $_POST['apellido1'];
    $apellidoDos = $_POST['apellido2'];
    $presentacion = $_POST['presentacion'];
    $correo = $_POST['correo'];

    $fotoPerfil = "";
    if ($_FILES["fotoPerfil"]["name"] != '') {
      $fotoPerfil = $_FILES["fotoPerfil"]["name"];
      $temp = $_FILES['fotoPerfil']['tmp_name'];
      if (move_uploaded_file($temp, 'images/' . $fotoPerfil)) {

        chmod('images/' . $fotoPerfil, 0777);
      }
    } else {
      $fotoPerfil = $cliente["fotoPerfil"];
    }

    $validarUsuario = true;

    //valida los campos

    $mayusculas = "/^[A-Z][a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/";

    if (empty($nombre)) {

      $errorNombrePropio = "Error, el nombre es necesario.";
      $validarUsuario = false;
    } elseif (!preg_match($mayusculas, $nombre)) {

      $errorNombrePropio = "Error, el nombre debe ir en mayúsculas";
      $validarUsuario = false;
    }


    if (empty($apellidoUno)) {

      $errorApellidoUno = "Error, el primer apellido es necesario.";
      $validarUsuario = false;
    } elseif (!preg_match($mayusculas, $apellidoUno)) {

      $errorApellidoUno = "Error, el apellido debe ir en mayúsculas";
      $validarUsuario = false;
    }


    if (empty($apellidoDos)) {

      $errorApellidoDos = "Error, el segundo apellido es necesario.";
      $validarUsuario = false;
    } elseif (!preg_match($mayusculas, $apellidoDos)) {

      $errorApellidoDos = "Error, el apellido debe ir en mayúsculas";
      $validarUsuario = false;
    }


    if (empty($correo)) {

      $errorCorreo = "Error, correo es necesario.";
      $validarUsuario = false;
    } elseif (!preg_match("/\w{3,}@{1}\w+\.{1}\w{2,3}$/", $correo)) {

      $errorCorreo = "Error, el correo es incorrecto.";
      $validarUsuario = false;
    }

    //actualiza un cliente
    if ($validarUsuario) {
      $editar = edicionCliente(
        asegurar($dni),
        asegurar($nombre),
        asegurar($apellidoUno),
        asegurar($apellidoDos),
        $fotoPerfil,
        asegurar($presentacion),
        asegurar($correo)
      );

      if ($editar == true) {
        header("Location: index.php?controller=obras&action=perfilCliente&id=" . $_SESSION["dni"]);

        exit();
      }
    }
  }

  include "./views/noUser/crearEditarUsuario.php";
}
