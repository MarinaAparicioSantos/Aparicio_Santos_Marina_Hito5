<?php

/**
 * @author Marina Aparicio Santos
 */

session_start();


$precioAlto = "";


/**
 * index funcion que muestra todas las obras
 *
 * @return void
 */
function index()
{
  require_once './models/obrasModel.php';
  $obras = mostrarObras();
  include "./views/noUser/principal.php";
}


/**
 * detallesObra funcion que muestra todos los datos de una obra
 *
 * @return void
 */
function detallesObra()
{

  require_once './models/obrasModel.php';
  $obraPuja = mostrarObraConcretaPuja($_GET['id']);
  $obra = mostrarObraConcreta($_GET['id']);
  $puntuaciones = mostrarPuntuacionObra($_GET['id']);
  $contarPuntuaciones = count($puntuaciones);


  //realiza la media de las puntuaciones de una obra
  $totalPuntuaciones = 0;

  foreach ($puntuaciones as $puntuacion) {

    $totalPuntuaciones += $puntuacion['puntuacion'];
  };

  $media = 0;

  if ($totalPuntuaciones > 0 && $contarPuntuaciones > 0) {
    $media = round($totalPuntuaciones / $contarPuntuaciones, 0);
  } else {

    $media = 'N/A';
  }

  if (isset($_SESSION['dni'])) {
    $puntuacionCliente = mostrarPuntuacionObraCliente($_GET['id'], $_SESSION['dni']);

    $idObra = "";
    $idCliente = "";
    $comentario = "";
    $puntuacion = "";
    $fechaComentario = "";

    $errorPuntuacion = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

      function asegurar($valor)
      {
        $valor = strip_tags($valor);
        $valor = stripslashes($valor);
        $valor = htmlspecialchars($valor);
        return $valor;
      }

      $idObra = $_GET['id'];
      $idCliente = $_SESSION['dni'];
      $comentario = $_POST['comentarios'];
      $puntuacion = $_POST['valoracion'];
      date_default_timezone_set('Europe/Madrid');
      $fechaComentario = date('Y-m-d H:i:s', time());

      if ($_POST['comentarios']) {

        //inerta los comentarios
        $insertar = insertComentarioObra(
          asegurar($idObra),
          asegurar($idCliente),
          asegurar($comentario),
          asegurar($fechaComentario)

        );
      }

      $validarPuntuacion = true;

      //valida que la puntuacion este entre 1 y 10
      if ($_POST['valoracion'] < 1) {

        $validarPuntuacion = false;
      } elseif ($_POST['valoracion'] > 10) {

        $validarPuntuacion = false;
      }

      if ($validarPuntuacion) {
        if (!$puntuacionCliente) {

          //inserta las puntuaciones
          $insertar = insertPuntuacionObra(
            asegurar($idObra),
            asegurar($idCliente),
            asegurar($puntuacion),

          );
        } else {

          //si un cliente ha insertado ya una puntuacion, la cambia por la antigua
          $editar = editarPuntuacionObra(
            asegurar($idObra),
            asegurar($idCliente),
            asegurar($puntuacion),
          );
        }
      }

      $_POST['comentarios'] = null;

      header("location: index.php?controller=obras&action=detallesObra&id=$idObra");
    }
  }

  $comentarios = mostrarComentarios($_GET['id']);

  include "./views/noUser/detallesObra.php";
}


/**
 * autores muestra los distintos autores
 *
 * @return void
 */
function autores()
{

  require_once './models/obrasModel.php';
  $autores = mostrarArtistas();
  include "./views/noUser/autores.php";
}


/**
 * perfilAutor muestra las caracteristicas de un autor
 *
 * @return void
 */
function perfilAutor()
{

  require_once './models/obrasModel.php';
  $autor = mostrarArtistaConcreto($_GET['id']);
  $obras = mostrarObrasPropias($_GET['id']);

  //realiza la media de entre todas las ountuaciones de todas sus obras
  $puntuaciones = mostrarPuntuacionObraAutor($_GET['id']);

  $puntuacionTotal = count($puntuaciones);

  $totalPuntuaciones = 0;

  foreach ($puntuaciones as $puntuacion) {

    $totalPuntuaciones += $puntuacion['puntuacion'];
  };

  $media = 0;

  if ($totalPuntuaciones > 0 && $puntuacionTotal > 0) {
    $media = round($totalPuntuaciones / $puntuacionTotal, 0);
  } else {

    $media = 'N/A';
  }

  include "./views/artist/perfilArtistaArt.php";
}


/**
 * subastas muestra todas las subastas activas
 *
 * @return void
 */
function subastas()
{

  require_once './models/obrasModel.php';
  $subastas = mostrarSubastas();
  include "./views/noUser/subastas.php";
}


/**
 * perfilCliente muestra los datos del cliente, sus comentarios y las subastas que ha ganado
 *
 * @return void
 */
function perfilCliente()
{
  require_once './models/obrasModel.php';
  $cliente = mostrarClienteConcreto($_GET['id']);
  $comentariosCliente = comentariosClientes($_GET['id']);
  $subastasGanador = subastaGanador($_GET['id']);

  include "./views/client/perfilCliente.php";
}


/**
 * ajaxSubasta se trata de los elementos que se le pasa al ajax
 *
 * @return void
 */
function ajaxSubasta()
{

  require_once './models/obrasModel.php';

  $precioAlto = precioAltoSubasta($_GET['id']);
  $numClientes = numPersonasPuja($_GET['id']);

  echo $precioAlto['precio'] . "," . $numClientes['clientes'] . "," . $precioAlto['dni_cliente'] . "," . $_SESSION['dni'] . "," . $precioAlto['nombre'] . "," . $precioAlto['apellido1'] . "," . $precioAlto['apellido2'];
}



/**
 * subastaObra muestra la subasta y hace que un cliente pueda proponer precios
 *
 * @return void
 */
function subastaObra()
{
  require_once './models/obrasModel.php';
  $subasta = mostrarSubasta($_GET['id']);
  $precioAlto = precioAltoSubasta($_GET['id']);
  $numClientes = numPersonasPuja($_GET['id']);


  if (isset($_SESSION['tipo'])) {

    //cambia el estado de la subasta a finalizado y añade el dni del ganador
    if ($_SESSION['tipo'] == "artista") {

      date_default_timezone_set('Europe/Madrid');
      $hoy = date('Y-m-d H:i:s', time());

      $diferenciaFechas = strtotime($hoy) - strtotime($subasta['fechaFinSubasta']);

      if ($diferenciaFechas > 0) {

        $estadoNuevo = "finalizado";

        cambiarEstadoSubasta($_GET['id'], $estadoNuevo);

        ganadorSubasta($_GET['id'], $precioAlto['dni_cliente']);
      }
    }
  }

  $idSubasta = "";
  $dniCliente = "";
  $precio = "";
  $error = "";
  $errorPrecioInicial = "";
  $errorPrecio = "";
  $insertar = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {


    function asegurar($valor)
    {
      $valor = strip_tags($valor);
      $valor = stripslashes($valor);
      $valor = htmlspecialchars($valor);
      return $valor;
    }

    $idSubasta = $_GET['id'];
    $dniCliente = $_SESSION['dni'];
    $precio = $_POST['proponerPrecio'];

    //valida que el precio propuesto sea mayor al inicial y al propuesto con anterioridad
    if ($subasta['precioInicial'] >= $precio) {

      $errorPrecioInicial = "Error, el precio propuesto tiene que ser mayor que el precio inicial.";
    } else if ($precioAlto['precio'] >= $precio) {

      $errorPrecio = "Error, el precio tiene que ser superior al insertado anteriormente.";
    } else {

      //un cliente propone un precio
      $insertar = proponerPrecioSubasta(
        asegurar($idSubasta),
        asegurar($dniCliente),
        asegurar($precio)

      );

      if (!$insertar) {

        $error = "ERROR";
      } else {

        header("location: index.php?controller=obras&action=subastaObra&id=" . $idSubasta);
      }
    }
  }

  include "./views/client/subastaObraCli.php";
}


/**
 * misSubastas muestra las subastas de un artista
 *
 * @return void
 */
function misSubastas()
{

  require_once './models/obrasModel.php';
  $subastas = mostrarSubastasPropias($_SESSION['dni']);
  include "./views/noUser/subastas.php";
}


/**
 * reservaObra muestra la pantalla de reserva de la obra
 *
 * @return void
 */
function reservaObra()
{
  require_once './models/usuariosModel.php';

  $subasta = mostrarSubasta($_GET['id']);
  $precioAlto = precioAltoSubasta($_GET['id']);

  $dni = "";
  $error = "";


  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //valida que el dni este correcto
    $dni = $_POST["dni"];

    if ($_SESSION['dni'] != $_POST['dni']) {

      $error = "DNI incorrecto";
    } else {

      header('Location: index.php?controller=obras&action=contactoArtista&id=' . $_GET['id']);
    }
  }

  include "./views/client/reservaObraPujadaCli.php";
}


/**
 * contactoArtista muestra el contacto del artista al finalizar la subasta al ganador
 *
 * @return void
 */
function contactoArtista()
{
  require_once './models/usuariosModel.php';

  $subasta = mostrarSubasta($_GET['id']);

  include "./views/client/contactoArtista.php";
}


/**
 * crearObra funcion que hace que un artista pueda crear una obra
 *
 * @return void
 */
function crearObra()
{
  require_once './models/obrasModel.php';

  $nombreObra = "";
  $dimensiones = "";
  $materiales = "";
  $fechaInicio = "";
  $fechaFin = "";
  $tipoObra = "";
  $descripcion = "";
  $dniArt = "";
  $fechaCreacionPost = "";


  $errorNombre = "";
  $errorDimensiones = "";
  $errorMateriales = "";
  $errorFechaInicio = "";
  $errorFechaFin = "";
  $errorTipoObra = "";
  $errorImagen = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    function asegurar($valor)
    {
      $valor = strip_tags($valor);
      $valor = stripslashes($valor);
      $valor = htmlspecialchars($valor);
      return $valor;
    }

    $nombreObra = $_POST["nombreObra"];
    $dimensiones = $_POST["dimensiones"];
    $materiales = $_POST["materiales"];
    $fechaInicio = $_POST["fechaInicio"];
    $fechaFin = $_POST["fechaFin"];
    $tipoObra = $_POST["tipoObra"];
    $descripcion = $_POST["descripcion"];
    $dniArt = $_SESSION["dni"];
    date_default_timezone_set('Europe/Madrid');
    $fechaCreacionPost = date('Y-m-d H:i:s', time());

    $target_dir = "./images/";
    $target_file = $target_dir . basename($_FILES["fotoObra"]["name"]);
    $fotoObra = $_FILES["fotoObra"]["name"];
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $empezarMayuscula = "/^[A-Z][a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ\s]+$/";

    $validarObra = true;

    //valida los campos de las obras
    if (empty($nombreObra)) {

      $errorNombre = "Error, el nombre es obligatorio.";

      $validarObra = false;
    } elseif (!preg_match("/^[A-Z][a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ\s]{1,29}+$/", $nombreObra)) {

      $errorNombre = "Error, el nombre debe empezar por mayúsculas y contener hasta 30 caracteres.";

      $validarObra = false;
    }

    if (empty($dimensiones)) {

      $errorDimensiones = "Error, es necesario indicar las dimensiones de la obra.";

      $validarObra = false;
    }

    if (empty($materiales)) {

      $errorMateriales = "Error, los materiales son obligatorios.";

      $validarObra = false;
    } elseif (!preg_match($empezarMayuscula, $materiales)) {

      $errorMateriales = "Error, debe empezar por mayúsculas.";

      $validarObra = false;
    }

    date_default_timezone_set('Europe/Madrid');
    $hoy = date('Y-m-d H:i:s', time());
    $diferenciaInicio = strtotime($hoy) - strtotime($fechaInicio);

    if (empty($fechaInicio)) {

      $errorFechaInicio = "Error, es necesario indicar la fecha de la creación de la obra.";

      $validarObra = false;
    } elseif ($diferenciaInicio < 0) {

      $errorFechaInicio = "Error, la fecha de inicio de la creación de la obra no puede ser futura.";

      $validarObra = false;
    } elseif (isset($fechaInicio) && isset($fechaFin)) {

      $diferenciaDias = strtotime($fechaInicio) - strtotime($fechaFin);

      if ($diferenciaDias > 0) {

        $errorFechaInicio = "Error, la fecha de inicio tiene que ser anterior a la fecha de fin.";

        $validarObra = false;
      }
    }

    $diferenciaFin = strtotime($hoy) - strtotime($fechaFin);

    if (empty($fechaInicio)) {

      $errorFechaFin = "Error, es necesario indicar la fecha de acabado de la obra.";

      $validarObra = false;
    } elseif ($diferenciaFin < 0) {

      $errorFechaFin = "Error, la fecha de acabado de la obra no puede ser futura.";

      $validarObra = false;
    } elseif (isset($fechaInicio) && isset($fechaFin)) {

      $diferenciaDias = strtotime($fechaInicio) - strtotime($fechaFin);

      if ($diferenciaDias > 0) {

        $errorFechaFin = "Error, la fecha de inicio tiene que ser anterior a la fecha de fin.";

        $validarObra = false;
      }
    }

    if (empty($tipoObra)) {

      $errorTipoObra = "Error, el tipo de obra es obligatorio.";

      $validarObra = false;
    } elseif (!preg_match($empezarMayuscula, $tipoObra)) {

      $errorTipoObra = "Error, debe empezar por mayúsculas.";

      $validarObra = false;
    }

    if (empty($fotoObra)) {

      $errorImagen = "Error, la imagen es obligatoria.";

      $validarObra = false;
    }

    if ($uploadOk == 0) {
      $validarObra = false;
      $errorImagen = "La imagen no se pudo guardar";
    } else {

      if ($validarObra) {
        if (move_uploaded_file($_FILES["fotoObra"]["tmp_name"], $target_file)) {

          //inserta obras
          $insertar = crearObraModel(
            asegurar($nombreObra),
            asegurar($dimensiones),
            asegurar($materiales),
            asegurar($fechaInicio),
            asegurar($fechaFin),
            asegurar($tipoObra),
            $fotoObra,
            asegurar($descripcion),
            asegurar($dniArt),
            asegurar($fechaCreacionPost)
          );
          if (!$insertar) {

            $error = "ERROR";
          } else {

            header("location: index.php?controller=obras&action=index");
          }
        } else {
          $validarObra = false;
          $errorImagen = "No se ha guardado la imagen de la obra.";
        }
      }
    }
  }

  include "./views/artist/crearEditarObra.php";
}


/**
 * editarObra funcion que hace que un artista pueda editar una obra
 *
 * @return void
 */
function editarObra()
{

  require_once './models/obrasModel.php';
  $obraEditar = mostrarSoloObra($_GET['id']);

  $nombreObra = "";
  $dimensiones = "";
  $materiales = "";
  $fechaInicio = "";
  $fechaFin = "";
  $tipoObra = "";
  $descripcion = "";
  $dniArt = "";
  $id = "";

  $errorNombre = "";
  $errorDimensiones = "";
  $errorMateriales = "";
  $errorFechaInicio = "";
  $errorFechaFin = "";
  $errorTipoObra = "";
  $errorImagen = "";


  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    function asegurar($valor)
    {
      $valor = strip_tags($valor);
      $valor = stripslashes($valor);
      $valor = htmlspecialchars($valor);
      return $valor;
    }

    $nombreObra = $_POST["nombreObra"];
    $dimensiones = $_POST["dimensiones"];
    $materiales = $_POST["materiales"];
    $fechaInicio = $_POST["fechaInicio"];
    $fechaFin = $_POST["fechaFin"];
    $tipoObra = $_POST["tipoObra"];
    $descripcion = $_POST["descripcion"];
    $dniArt = $_SESSION["dni"];
    $id = $_GET["id"];

    $fotoObra = '';

    if ($_FILES["fotoObra"]["name"] != '') {
      $fotoObra = $_FILES["fotoObra"]["name"];
      $temp = $_FILES['fotoObra']['tmp_name'];
      if (move_uploaded_file($temp, 'images/' . $fotoObra)) {

        chmod('images/' . $fotoObra, 0777);
      }
    } else {
      $fotoObra = $obraEditar["fotoObra"];
    }

    $empezarMayuscula = "/^[A-Z][a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ\s]+$/";

    $validarObra = true;

    //valida los campos
    if (empty($nombreObra)) {

      $errorNombre = "Error, el nombre es obligatorio.";

      $validarObra = false;
    } elseif (!preg_match("/^[A-Z][a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ\s]{1,29}+$/", $nombreObra)  && !preg_match("/^[A-Z]{1}+$/", $nombreObra)) {

      $errorNombre = "Error, el nombre debe empezar por mayúsculas y contener hasta 30 caracteres.";

      $validarObra = false;
    }

    if (empty($dimensiones)) {

      $errorDimensiones = "Error, es necesario indicar las dimensiones de la obra.";

      $validarObra = false;
    }

    if (empty($materiales)) {

      $errorMateriales = "Error, los materiales son obligatorios.";

      $validarObra = false;
    } elseif (!preg_match($empezarMayuscula, $materiales)) {

      $errorMateriales = "Error, debe empezar por mayúsculas.";

      $validarObra = false;
    }

    date_default_timezone_set('Europe/Madrid');
    $hoy = date('Y-m-d H:i:s', time());
    $diferenciaInicio = strtotime($hoy) - strtotime($fechaInicio);

    if (empty($fechaInicio)) {

      $errorFechaInicio = "Error, es necesario indicar la fecha de la creación de la obra.";

      $validarObra = false;
    } elseif ($diferenciaInicio < 0) {

      $errorFechaInicio = "Error, la fecha de inicio de la creación de la obra no puede ser futura.";

      $validarObra = false;
    } elseif (isset($fechaInicio) && isset($fechaFin)) {

      $diferenciaDias = strtotime($fechaInicio) - strtotime($fechaFin);

      if ($diferenciaDias > 0) {

        $errorFechaInicio = "Error, la fecha de inicio tiene que ser anterior a la fecha de fin.";

        $validarObra = false;
      }
    }

    $diferenciaFin = strtotime($hoy) - strtotime($fechaFin);

    if (empty($fechaInicio)) {

      $errorFechaFin = "Error, es necesario indicar la fecha de acabado de la obra.";

      $validarObra = false;
    } elseif ($diferenciaFin < 0) {

      $errorFechaFin = "Error, la fecha de acabado de la obra no puede ser futura.";

      $validarObra = false;
    } elseif (isset($fechaInicio) && isset($fechaFin)) {

      $diferenciaDias = strtotime($fechaInicio) - strtotime($fechaFin);

      if ($diferenciaDias > 0) {

        $errorFechaFin = "Error, la fecha de inicio tiene que ser anterior a la fecha de fin.";

        $validarObra = false;
      }
    }

    if (empty($tipoObra)) {

      $errorTipoObra = "Error, el tipo de obra es obligatorio.";

      $validarObra = false;
    } elseif (!preg_match($empezarMayuscula, $tipoObra)) {

      $errorTipoObra = "Error, debe empezar por mayúsculas.";

      $validarObra = false;
    }

    if (empty($fotoObra)) {

      $errorImagen = "Error, la imagen es obligatoria.";

      $validarObra = false;
    }

    if ($validarObra) {

      //actualiza las obras
      $editar = edicionObra(
        $id,
        $dniArt,
        asegurar($nombreObra),
        asegurar($dimensiones),
        asegurar($materiales),
        asegurar($fechaInicio),
        asegurar($fechaFin),
        asegurar($tipoObra),
        $fotoObra,
        asegurar($descripcion)
      );
      if ($editar == true) {
        $idObra = $_GET['id'];
        header("Location: index.php?controller=obras&action=detallesObra&id=$idObra");

        exit();
      }
    }
  }

  include "./views/artist/crearEditarObra.php";
}



/**
 * crearSubasta funcion con el que un artista puede crear una obra
 *
 * @return void
 */
function crearSubasta()
{

  require_once './models/obrasModel.php';

  $nombresObras = mostrarNombreObra($_SESSION['dni']);

  $idObra = "";
  $precioInicial = "";
  $fechaInicioSubasta = "";
  $fechaFinSubasta = "";
  $descripcion = "";
  $estado = "";
  $errorFecha = "";
  $errorPrecio = "";
  $insertar = false;
  $diferencia = 0;

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    function asegurar($valor)
    {
      $valor = strip_tags($valor);
      $valor = stripslashes($valor);
      $valor = htmlspecialchars($valor);
      return $valor;
    }

    $idObra = $_POST['idObra'];
    $precioInicial = $_POST['precioInicial'];
    date_default_timezone_set('Europe/Madrid');
    $fechaInicioSubasta = date('Y-m-d H:i:s', time());
    $fechaFinSubasta = $_POST['fechaFin'];
    $descripcion = $_POST['descripcion'];
    $estado = "vigente";

    $diferencia = strtotime($fechaFinSubasta) - strtotime($fechaInicioSubasta);

    $validarSubasta = true;

    //valida los campos

    if (empty($fechaFinSubasta)) {

      $errorFecha = "Error, la fecha de fin de la subasta es obligatoria.";
      $validarSubasta = false;
    } elseif ($diferencia < 0) {

      $errorFecha = "Error, la fecha de fin de la subasta no puede ser anterior a la de ahora.";
      $validarSubasta = false;
    }

    if (empty($precioInicial)) {

      $errorPrecio = "Error, el precio inicial es obligatorio.";
      $validarSubasta = false;
    } elseif ($precioInicial < 1) {

      $errorPrecio = "Error, el precio inicial no puede ser menor a 1€";
      $validarSubasta = false;
    }

    if ($validarSubasta) {

      //crea una subasta
      $insertar = creacionSubasta(
        asegurar($idObra),
        asegurar($precioInicial),
        asegurar($fechaInicioSubasta),
        asegurar($fechaFinSubasta),
        asegurar($descripcion),
        $estado

      );

      header("location: index.php?controller=obras&action=index");
    }
  }

  include "./views/artist/crearEditarSubastaArt.php";
}


/**
 * editarSubasta funcion con el que un artista edita una subasta
 *
 * @return void
 */
function editarSubasta()
{

  require_once './models/obrasModel.php';

  $subasta = mostrarSubasta($_GET['id']);

  $idSubasta = "";
  $descripcionSubasta = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    function asegurar($valor)
    {
      $valor = strip_tags($valor);
      $valor = stripslashes($valor);
      $valor = htmlspecialchars($valor);
      return $valor;
    }

    $idSubasta = $_GET['id'];
    $descripcionSubasta = $_POST['descripcion'];

    //actualiza la subasta
    $editar = edicionSubasta(
      $idSubasta,
      asegurar($descripcionSubasta),

    );
    if ($editar == true) {
      $idSubasta = $_GET['id'];
      header("Location: index.php?controller=obras&action=subastaObra&id=$idSubasta");

      exit();
    } else {
      $error = "Datos incorrectos o no se ha actualizado nada";
      echo $error;
    }
  }

  include "./views/artist/crearEditarSubastaArt.php";
}



/**
 * adminClientes muestra todos los comentarios
 *
 * @return void
 */
function adminClientes()
{
  require_once './models/obrasModel.php';

  $todosComentarios = mostrarTodosComentarios();

  include "./views/admin/clientesAdm.php";
}


/**
 * clientes muestra todos los clientes
 *
 * @return void
 */
function clientes()
{
  require_once './models/obrasModel.php';

  $clientes = mostrarClientes();

  include "./views/artist/clientes.php";
}


/**
 * misObras muestra las obras de un artista
 *
 * @return void
 */
function misObras()
{
  require_once './models/obrasModel.php';
  $obras = mostrarObrasPropias($_SESSION['dni']);
  include "./views/artist/obrasArtista.php";
}


/**
 * eliminarObra elimina obras desde la pagina principal
 *
 * @return void
 */
function eliminarObra()
{
  require_once './models/obrasModel.php';

  borrarObra($_GET['id']);

  header('location: index.php?controller=obras&action=index');
}


/**
 * borrarObraArtista elimina obras desde la lista de obras de un artista
 *
 * @return void
 */
function borrarObraArtista()
{
  require_once './models/obrasModel.php';

  borrarObra($_GET['id']);

  header('location: index.php?controller=obras&action=misObras');
}


/**
 * borrarComentarios el administrador elimina los comentarios
 *
 * @return void
 */
function borrarComentarios()
{
  require_once './models/obrasModel.php';

  borrarComentario($_GET['id']);

  header('location: index.php?controller=obras&action=adminClientes');
}


/**
 * borrarComentariosClientes un cliente elimina sus comentarios desde su perfil
 *
 * @return void
 */
function borrarComentariosClientes()
{
  require_once './models/obrasModel.php';

  borrarComentario($_GET['id']);

  header('location: index.php?controller=obras&action=perfilCliente&id=' . $_SESSION['dni']);
}



/**
 * eliminarSubastas un artista elimina sus subastas
 *
 * @return void
 */
function eliminarSubastas()
{
  require_once './models/obrasModel.php';

  borrarSubasta($_GET['id']);

  header('location: index.php?controller=obras&action=misSubastas');
}

/**
 * eliminarObraPerfil un autor elimina una obra desde su perfil
 *
 * @return void
 */
function eliminarObraPerfil()
{
  require_once './models/obrasModel.php';

  borrarObra($_GET['id']);

  header('location: index.php?controller=obras&action=perfilAutor&id=' . $_SESSION['dni']);
}


/**
 * borrarComentarioCliente un cliente elimina su comentario desde la publicacion de la obra
 *
 * @return void
 */
function borrarComentarioCliente()
{
  require_once './models/obrasModel.php';

  borrarComentario($_GET['id']);

  header('location: index.php?controller=obras&action=detallesObra&id=' . $_GET['idObra']);
}
