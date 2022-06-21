<?php

$servidor = "localhost";
$baseDatos = "marinaproyectointegrado";
$usuario = "developer";
$pass = "developer";


/**
 * crearConexion crea la conexion con la base de datos
 *
 * @return void
 */
function crearConexion()
{
    $servidor = "localhost";
    $baseDatos = "marinaproyectointegrado";
    $user = "developer";
    $pass = "developer";
    try {
        return new PDO("mysql:host=$servidor;dbname=$baseDatos", $user, $pass);
    } catch (PDOException $e) {
        return false;
    }
}


/**
 * mostrarObras muestra los datos de las obras y sus autores
 *
 * @return void
 */
function mostrarObras()
{
    try {
        $conn = crearConexion();

        $sql = $conn->prepare("SELECT *
                                FROM usuarios u, artistas a, obra o
                                WHERE u.dni = a.dni_art
                                AND a.dni_art = o.dni_art
                                ORDER BY o.fechaCreacionPost
                                DESC");
        $sql->execute();
        $matriz = [];
        while ($al = $sql->fetch(PDO::FETCH_BOTH)) {
            $matriz[] = $al;
        }
        return $matriz;
    } catch (PDOException $e) {
        return null;
    }
    $conn = null;
}

/**
 * mostrarObraConcretaPuja muestra los datos de una subasta
 *
 * @param  mixed $id
 * @return void
 */
function mostrarObraConcretaPuja($id)
{

    try {
        $conn = crearConexion();

        $sql = $conn->prepare("SELECT * , s.id AS idPuja
                                FROM usuarios u, artistas a, obra o, subasta s
                                WHERE u.dni = a.dni_art
                                AND a.dni_art = o.dni_art 
                                AND s.id_obra = o.id
                                AND o.id = ? ");

        $sql->bindParam(1, $id);
        $sql->execute();

        $elemento = $sql->fetch(PDO::FETCH_ASSOC);
        return $elemento;
    } catch (PDOException $e) {
        return null;
    }
    $conn = null;
}


/**
 * mostrarObraConcreta muestra una obra con los datos de su autor
 *
 * @param  mixed $id
 * @return void
 */
function mostrarObraConcreta($id)
{

    try {
        $conn = crearConexion();

        $sql = $conn->prepare("SELECT *
                                FROM usuarios u, artistas a, obra o
                                WHERE u.dni = a.dni_art
                                AND a.dni_art = o.dni_art 
                                AND o.id = ? ");

        $sql->bindParam(1, $id);
        $sql->execute();

        $elemento = $sql->fetch(PDO::FETCH_ASSOC);
        return $elemento;
    } catch (PDOException $e) {
        return null;
    }
    $conn = null;
}


/**
 * mostrarArtistas muestra todos los artistas
 *
 * @return void
 */
function mostrarArtistas()
{

    try {
        $conn = crearConexion();

        $sql = $conn->prepare("SELECT *
                                FROM usuarios u, artistas a
                                WHERE u.dni = a.dni_art");
        $sql->execute();
        $matriz = [];
        while ($al = $sql->fetch(PDO::FETCH_BOTH)) {
            $matriz[] = $al;
        }
        return $matriz;
    } catch (PDOException $e) {
        return null;
    }
    $conn = null;
}


/**
 * mostrarArtistaConcreto muestra un artista en concreto
 *
 * @param  mixed $dni
 * @return void
 */
function mostrarArtistaConcreto($dni)
{

    try {
        $conn = crearConexion();

        $sql = $conn->prepare("SELECT *
                                FROM usuarios u, artistas a
                                WHERE u.dni = a.dni_art
                                AND u.dni = ?");

        $sql->bindParam(1, $dni);
        $sql->execute();

        $elemento = $sql->fetch(PDO::FETCH_ASSOC);
        return $elemento;
    } catch (PDOException $e) {
        return null;
    }
    $conn = null;
}

/**
 * mostrarClienteConcreto muestra un cliente en concreto
 *
 * @param  mixed $dni
 * @return void
 */
function mostrarClienteConcreto($dni)
{

    try {
        $conn = crearConexion();

        $sql = $conn->prepare("SELECT *
                                FROM usuarios
                                WHERE dni = ?");

        $sql->bindParam(1, $dni);
        $sql->execute();

        $elemento = $sql->fetch(PDO::FETCH_ASSOC);
        return $elemento;
    } catch (PDOException $e) {
        return null;
    }
    $conn = null;
}

/**
 * mostrarSubastas muestra las subastas activas
 *
 * @return void
 */
function mostrarSubastas()
{

    try {
        $conn = crearConexion();

        $sql = $conn->prepare("SELECT *
                                FROM artistas a, obra o, subasta s
                                WHERE a.dni_art = o.dni_art
                                AND o.id = s.id_obra
                                AND s.estado = 'vigente'
                                ORDER BY s.fechaInicioSubasta
                                DESC");
        $sql->execute();
        $matriz = [];
        while ($al = $sql->fetch(PDO::FETCH_BOTH)) {
            $matriz[] = $al;
        }
        return $matriz;
    } catch (PDOException $e) {
        return null;
    }
    $conn = null;
}


/**
 * mostrarSubasta muestra los datos de una subasta
 *
 * @param  mixed $id
 * @return void
 */
function mostrarSubasta($id)
{

    try {
        $conn = crearConexion();

        $sql = $conn->prepare("SELECT *
                                FROM artistas a, obra o, subasta s, usuarios u
                                WHERE a.dni_art = o.dni_art
                                AND a.dni_art = u.dni
                                AND o.id = s.id_obra
                                AND s.id = ? ");

        $sql->bindParam(1, $id);
        $sql->execute();

        $elemento = $sql->fetch(PDO::FETCH_ASSOC);
        return $elemento;
    } catch (PDOException $e) {
        return null;
    }
    $conn = null;
}

/**
 * mostrarSubastasPropias muestra las subastas de un artista concreto
 *
 * @param  mixed $dni
 * @return void
 */
function mostrarSubastasPropias($dni)
{

    try {
        $conn = crearConexion();

        $sql = $conn->prepare("SELECT *
                                FROM artistas a, obra o, subasta s
                                where a.dni_art = o.dni_art
                                AND o.id = s.id_obra
                                AND a.dni_art = ? 
                                ORDER BY s.fechaInicioSubasta
                                DESC");

        $sql->bindParam(1, $dni);
        $sql->execute();

        $matriz = [];
        while ($al = $sql->fetch(PDO::FETCH_BOTH)) {
            $matriz[] = $al;
        }
        return $matriz;
    } catch (PDOException $e) {
        return null;
    }
    $conn = null;
}

/**
 * mostrarObrasPropias muestra las obras de un artista concreto
 *
 * @param  mixed $dni
 * @return void
 */
function mostrarObrasPropias($dni)
{
    try {
        $conn = crearConexion();

        $sql = $conn->prepare("SELECT *, o.id AS idObra
                                FROM usuarios u, artistas a, obra o
                                WHERE u.dni = a.dni_art
                                AND a.dni_art = o.dni_art
                                AND a.dni_art =?");
        $sql->bindParam(1, $dni);
        $sql->execute();
        $matriz = [];
        while ($al = $sql->fetch(PDO::FETCH_BOTH)) {
            $matriz[] = $al;
        }
        return $matriz;
    } catch (PDOException $e) {
        return null;
    }
    $conn = null;
}

/**
 * crearObraModel crea una obra
 *
 * @param  mixed $nombreObra
 * @param  mixed $dimensiones
 * @param  mixed $materiales
 * @param  mixed $fechaInicio
 * @param  mixed $fechaFin
 * @param  mixed $tipoObra
 * @param  mixed $foto
 * @param  mixed $descripcion
 * @param  mixed $dniArt
 * @param  mixed $fechaCreacionPost
 * @return void
 */
function crearObraModel($nombreObra, $dimensiones, $materiales, $fechaInicio, $fechaFin, $tipoObra, $foto, $descripcion, $dniArt, $fechaCreacionPost)
{

    try {
        $conn = crearConexion();


        $consulta = $conn->prepare("INSERT INTO obra (nombreObra, dimensiones, materiales, fechaInicio, fechaFin, tipoObra, fotoObra, descripcion ,dni_art, fechaCreacionPost) VALUES (?,?,?,?,?,?,?,?,?,?)");
        $consulta->bindParam(1, $nombreObra);
        $consulta->bindParam(2, $dimensiones);
        $consulta->bindParam(3, $materiales);
        $consulta->bindParam(4, $fechaInicio);
        $consulta->bindParam(5, $fechaFin);
        $consulta->bindParam(6, $tipoObra);
        $consulta->bindParam(7, $foto);
        $consulta->bindParam(8, $descripcion);
        $consulta->bindParam(9, $dniArt);
        $consulta->bindParam(10, $fechaCreacionPost);

        $consulta->execute();
        return true;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        return false;
    }
    $conn = null;
}

/**
 * mostrarSoloObra muestra los datos de una obra
 *
 * @param  mixed $id
 * @return void
 */
function mostrarSoloObra($id)
{

    try {
        $conn = crearConexion();

        $sql = $conn->prepare("SELECT *
                                FROM obra o
                                WHERE o.id = ? ");

        $sql->bindParam(1, $id);
        $sql->execute();

        $elemento = $sql->fetch(PDO::FETCH_ASSOC);
        return $elemento;
    } catch (PDOException $e) {
        return null;
    }
    $conn = null;
}

/**
 * edicionObra edita una obra
 *
 * @param  mixed $id
 * @param  mixed $dniArt
 * @param  mixed $nombreObra
 * @param  mixed $dimensiones
 * @param  mixed $materiales
 * @param  mixed $fechaInicio
 * @param  mixed $fechaFin
 * @param  mixed $tipoObra
 * @param  mixed $fotoObra
 * @param  mixed $descripcion
 * @return void
 */
function edicionObra($id, $dniArt, $nombreObra, $dimensiones, $materiales, $fechaInicio, $fechaFin, $tipoObra, $fotoObra, $descripcion)
{

    try {
        $conn = crearConexion();


        $consulta = $conn->prepare("UPDATE obra SET nombreObra=:nombreObra, dimensiones=:dimensiones, materiales=:materiales,
        fechaInicio=:fechaInicio,fechaFin=:fechaFin,tipoObra=:tipoObra,fotoObra=:fotoObra,descripcion=:descripcion WHERE id=:id AND dni_art=:dni_art ");

        $parametros = array(
            ":id" => $id, ":dni_art" => $dniArt, ":nombreObra" => $nombreObra, ":dimensiones" => $dimensiones, ":materiales" => $materiales, ":fechaInicio" => $fechaInicio,
            ":fechaFin" => $fechaFin, ":tipoObra" => $tipoObra, ":fotoObra" => $fotoObra, ":descripcion" => $descripcion
        );

        return $consulta->execute($parametros);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        return false;
    }
}

/**
 * mostrarNombreObra muestra las obras que no existan en la tabla subasta
 *
 * @param  mixed $dniArtista
 * @return void
 */
function mostrarNombreObra($dniArtista)
{

    try {
        $conn = crearConexion();

        $sql = $conn->prepare("SELECT o.*, o.id AS id
                                FROM obra o
                                WHERE NOT EXISTS ( SELECT * FROM subasta s 
                                WHERE o.id = s.id_obra)
                                AND o.dni_art = ?");
        $sql->bindParam(1, $dniArtista);
        $sql->execute();
        $matriz = [];
        while ($al = $sql->fetch(PDO::FETCH_BOTH)) {
            $matriz[] = $al;
        }
        return $matriz;
    } catch (PDOException $e) {
        return null;
    }
    $conn = null;
}

/**
 * creacionSubasta crea una subasta
 *
 * @param  mixed $idObra
 * @param  mixed $precioInicial
 * @param  mixed $fechaInicioSubasta
 * @param  mixed $fechaFinSubasta
 * @param  mixed $descripcion
 * @param  mixed $estado
 * @return void
 */
function creacionSubasta($idObra, $precioInicial, $fechaInicioSubasta, $fechaFinSubasta, $descripcion, $estado)
{

    try {
        $conn = crearConexion();


        $consulta = $conn->prepare("INSERT INTO subasta (id_obra, precioInicial, fechaInicioSubasta, fechaFinSubasta, descripcion, estado) VALUES (?,?,?,?,?,?)");
        $consulta->bindParam(1, $idObra);
        $consulta->bindParam(2, $precioInicial);
        $consulta->bindParam(3, $fechaInicioSubasta);
        $consulta->bindParam(4, $fechaFinSubasta);
        $consulta->bindParam(5, $descripcion);
        $consulta->bindParam(6, $estado);


        $consulta->execute();
        return true;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        return false;
    }
    $conn = null;
}

/**
 * creacionCliente crea un nuevo usuario cliente
 *
 * @param  mixed $dni
 * @param  mixed $nombreUsuario
 * @param  mixed $contrasenya
 * @param  mixed $tipo
 * @param  mixed $nombre
 * @param  mixed $apellidoUno
 * @param  mixed $apellidoDos
 * @param  mixed $fotoPerfil
 * @param  mixed $presentacion
 * @param  mixed $correo
 * @return void
 */
function creacionCliente($dni, $nombreUsuario, $contrasenya, $tipo, $nombre, $apellidoUno, $apellidoDos, $fotoPerfil, $presentacion, $correo)
{

    try {
        $conn = crearConexion();

        $consulta = $conn->prepare("INSERT INTO usuarios (dni, nombre_usuario, contrasenya, tipo, nombre, apellido1, apellido2, fotoPerfil, presentacion, correo) VALUES (?,?,?,?,?,?,?,?,?,?)");
        $consulta->bindParam(1, $dni);
        $consulta->bindParam(2, $nombreUsuario);
        $consulta->bindParam(3, $contrasenya);
        $consulta->bindParam(4, $tipo);
        $consulta->bindParam(5, $nombre);
        $consulta->bindParam(6, $apellidoUno);
        $consulta->bindParam(7, $apellidoDos);
        $consulta->bindParam(8, $fotoPerfil);
        $consulta->bindParam(9, $presentacion);
        $consulta->bindParam(10, $correo);

        $consulta->execute();
        return true;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        return false;
    }
    $conn = null;
}

/**
 * creacionArtista inserta los datos de un artista
 *
 * @param  mixed $dni
 * @param  mixed $nombreArtistico
 * @param  mixed $fechaComienzo
 * @param  mixed $tecnicas
 * @param  mixed $redSocial
 * @return void
 */
function creacionArtista($dni, $nombreArtistico, $fechaComienzo, $tecnicas, $redSocial)
{

    try {
        $conn = crearConexion();

        $consulta = $conn->prepare("INSERT INTO artistas (dni_art, nombreArtistico, fechaComienzo, tecnicas, redSocial) VALUES (?,?,?,?,?)");
        $consulta->bindParam(1, $dni);
        $consulta->bindParam(2, $nombreArtistico);
        $consulta->bindParam(3, $fechaComienzo);
        $consulta->bindParam(4, $tecnicas);
        $consulta->bindParam(5, $redSocial);

        $consulta->execute();
        return true;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        return false;
    }
    $conn = null;
}

/**
 * edicionCliente edita los datos de un cliente
 *
 * @param  mixed $dni
 * @param  mixed $nombre
 * @param  mixed $apellidoUno
 * @param  mixed $apellidoDos
 * @param  mixed $fotoPerfil
 * @param  mixed $presentacion
 * @param  mixed $correo
 * @return void
 */
function edicionCliente($dni, $nombre, $apellidoUno, $apellidoDos, $fotoPerfil, $presentacion, $correo)
{

    try {
        $conn = crearConexion();


        $consulta = $conn->prepare("UPDATE usuarios SET nombre=:nombre,apellido1=:apellido1,
        apellido2=:apellido2,fotoPerfil=:fotoPerfil,presentacion=:presentacion, correo=:correo WHERE dni=:dni");

        $parametros = array(
            ":dni" => $dni, ":nombre" => $nombre, ":apellido1" => $apellidoUno, ":apellido2" => $apellidoDos,
            ":fotoPerfil" => $fotoPerfil, ":presentacion" => $presentacion, ":correo" => $correo
        );

        return $consulta->execute($parametros);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        return false;
    }
}

/**
 * edicionArtista edita los datos de un artista
 *
 * @param  mixed $dniArt
 * @param  mixed $nombreArtistico
 * @param  mixed $fechaComienzo
 * @param  mixed $tecnicas
 * @param  mixed $redSocial
 * @return void
 */
function edicionArtista($dniArt, $nombreArtistico, $fechaComienzo, $tecnicas, $redSocial)
{

    try {
        $conn = crearConexion();


        $consulta = $conn->prepare("UPDATE artistas SET nombreArtistico=:nombreArtistico,
         fechaComienzo=:fechaComienzo,tecnicas=:tecnicas,redSocial=:redSocial WHERE dni_art=:dni_art");

        $parametros = array(
            ":dni_art" => $dniArt, ":nombreArtistico" => $nombreArtistico, ":fechaComienzo" => $fechaComienzo,
            ":tecnicas" => $tecnicas, ":redSocial" => $redSocial
        );

        return $consulta->execute($parametros);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        return false;
    }
}

/**
 * mostrarClientes muestra los usuarios clientes
 *
 * @return void
 */
function mostrarClientes()
{

    try {
        $conn = crearConexion();

        $sql = $conn->prepare("SELECT *
                                FROM usuarios
                                WHERE tipo = 'cliente'");
        $sql->execute();
        $matriz = [];
        while ($al = $sql->fetch(PDO::FETCH_BOTH)) {
            $matriz[] = $al;
        }
        return $matriz;
    } catch (PDOException $e) {
        return null;
    }
    $conn = null;
}

/**
 * insertComentarioObra hace que un cliente pueda insertar un comentario
 *
 * @param  mixed $idObra
 * @param  mixed $idCliente
 * @param  mixed $comentario
 * @param  mixed $fechaComentario
 * @return void
 */
function insertComentarioObra($idObra, $idCliente, $comentario, $fechaComentario)
{

    try {
        $conn = crearConexion();

        $consulta = $conn->prepare("INSERT INTO clientecomentaobra (id_obra, id_cliente, comentario, fechaComentario) VALUES (?,?,?,?)");
        $consulta->bindParam(1, $idObra);
        $consulta->bindParam(2, $idCliente);
        $consulta->bindParam(3, $comentario);
        $consulta->bindParam(4, $fechaComentario);

        $consulta->execute();
        return true;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        return false;
    }
    $conn = null;
}

/**
 * mostrarComentarios muestra los comentarios de una obra
 *
 * @param  mixed $id
 * @return void
 */
function mostrarComentarios($id)
{


    try {
        $conn = crearConexion();

        $sql = $conn->prepare("SELECT *, c.id AS idComentario, o.id AS idObra
                                FROM clientecomentaobra c, usuarios u, obra o
                                WHERE c.id_cliente = u.dni
                                AND c.id_obra = o.id
                                AND o.id = ?
                                ORDER BY c.fechaComentario
                                DESC");
        $sql->bindParam(1, $id);
        $sql->execute();
        $matriz = [];
        while ($al = $sql->fetch(PDO::FETCH_BOTH)) {
            $matriz[] = $al;
        }
        return $matriz;
    } catch (PDOException $e) {
        return null;
    }
    $conn = null;
}

/**
 * mostrarTodosComentarios muestra todos los comentarios
 *
 * @return void
 */
function mostrarTodosComentarios()
{


    try {
        $conn = crearConexion();

        $sql = $conn->prepare("SELECT *, c.id AS idComentario
                                FROM clientecomentaobra c, usuarios u, obra o
                                where c.id_cliente = u.dni
                                AND c.id_obra = o.id");
        $sql->execute();
        $matriz = [];
        while ($al = $sql->fetch(PDO::FETCH_BOTH)) {
            $matriz[] = $al;
        }
        return $matriz;
    } catch (PDOException $e) {
        return null;
    }
    $conn = null;
}

/**
 * borrarComentario elimina un comentario
 *
 * @param  mixed $id
 * @return void
 */
function borrarComentario($id)
{

    try {
        $conn = crearConexion();
        $consulta = $conn->prepare("DELETE FROM clientecomentaobra WHERE id=?");
        $consulta->bindParam(1, $id);
        return $consulta->execute();
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        return false;
    }
    $conexion = null;
}

/**
 * insertPuntuacionObra hace que un cliente pueda insertar una puntuacion
 *
 * @param  mixed $idObra
 * @param  mixed $dniCliente
 * @param  mixed $puntuacion
 * @return void
 */
function insertPuntuacionObra($idObra, $dniCliente, $puntuacion)
{

    try {
        $conn = crearConexion();

        $consulta = $conn->prepare("INSERT INTO clientepuntuaobra (id_obra, dni_cliente, puntuacion) VALUES (?,?,?)");
        $consulta->bindParam(1, $idObra);
        $consulta->bindParam(2, $dniCliente);
        $consulta->bindParam(3, $puntuacion);

        $consulta->execute();
        return true;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        return false;
    }
    $conn = null;
}


/**
 * mostrarPuntuacionObra selecciona los comentarios de una obra
 *
 * @param  mixed $idObra
 * @return void
 */
function mostrarPuntuacionObra($idObra)
{

    try {
        $conn = crearConexion();

        $sql = $conn->prepare("SELECT *
                                FROM clientepuntuaobra
                                WHERE id_obra = ?");
        $sql->bindParam(1, $idObra);
        $sql->execute();
        $matriz = [];
        while ($al = $sql->fetch(PDO::FETCH_BOTH)) {
            $matriz[] = $al;
        }
        return $matriz;
    } catch (PDOException $e) {
        return null;
    }
    $conn = null;
}

/**
 * mostrarPuntuacionObraCliente muestra la puntuacion de un cliente en concreto
 *
 * @param  mixed $idObra
 * @param  mixed $dniCliente
 * @return void
 */
function mostrarPuntuacionObraCliente($idObra, $dniCliente)
{

    try {
        $conn = crearConexion();

        $sql = $conn->prepare("SELECT *
                                FROM clientepuntuaobra
                                WHERE id_obra = ?
                                AND dni_cliente = ?");
        $sql->bindParam(1, $idObra);
        $sql->bindParam(2, $dniCliente);
        $sql->execute();
        $elemento = $sql->fetch(PDO::FETCH_ASSOC);
        return $elemento;
    } catch (PDOException $e) {
        return null;
    }
    $conn = null;
}

/**
 * mostrarPuntuacionObraAutor muestra las puntuaciones de todas las obras de un autor
 *
 * @param  mixed $dniArtista
 * @return void
 */
function mostrarPuntuacionObraAutor($dniArtista)
{

    try {
        $conn = crearConexion();

        $sql = $conn->prepare("SELECT puntuacion
                                FROM clientepuntuaobra c, obra o
                                WHERE c.id_obra = o.id
                                AND o.dni_art = ?");
        $sql->bindParam(1, $dniArtista);
        $sql->execute();
        $matriz = [];
        while ($al = $sql->fetch(PDO::FETCH_BOTH)) {
            $matriz[] = $al;
        }
        return $matriz;
    } catch (PDOException $e) {
        return null;
    }
    $conn = null;
}

/**
 * editarPuntuacionObra edita las puntuaciones de una obra
 *
 * @param  mixed $idObra
 * @param  mixed $dniCliente
 * @param  mixed $puntuacion
 * @return void
 */
function editarPuntuacionObra($idObra, $dniCliente, $puntuacion)
{

    try {
        $conn = crearConexion();


        $consulta = $conn->prepare("UPDATE clientepuntuaobra SET puntuacion=:puntuacion 
         WHERE dni_cliente=:dni_cliente AND id_obra=:id_obra");

        $parametros = array(
            ":id_obra" => $idObra, ":dni_cliente" => $dniCliente, ":puntuacion" => $puntuacion
        );

        return $consulta->execute($parametros);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        return false;
    }
}

/**
 * proponerPrecioSubasta hace que un cliente pueda proponer un precio de una obra
 *
 * @param  mixed $idSubasta
 * @param  mixed $dniCliente
 * @param  mixed $precio
 * @return void
 */
function proponerPrecioSubasta($idSubasta, $dniCliente, $precio)
{


    try {
        $conn = crearConexion();

        $consulta = $conn->prepare("INSERT INTO clientepuja (id_subasta, dni_cliente, precio) VALUES (?,?,?)");
        $consulta->bindParam(1, $idSubasta);
        $consulta->bindParam(2, $dniCliente);
        $consulta->bindParam(3, $precio);

        $consulta->execute();
        return true;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        return false;
    }
    $conn = null;
}

/**
 * precioAltoSubasta selecciona el precio mas alto y los datos del cliente que haya propuesto el precio mas alto de una puja
 *
 * @param  mixed $idSubasta
 * @return void
 */
function precioAltoSubasta($idSubasta)
{

    try {
        $conn = crearConexion();

        $sql = $conn->prepare("SELECT c.dni_cliente AS dni_cliente, c.precio AS precio , u.nombre AS nombre, u.apellido1 AS apellido1, u.apellido2 AS apellido2, u.correo AS correo
                                FROM clientepuja c, usuarios u
                                WHERE c.dni_cliente = u.dni
                                AND precio = (SELECT MAX(precio) FROM clientepuja WHERE id_subasta = ?)
                                AND id_subasta = ?");

        $sql->bindParam(1, $idSubasta);
        $sql->bindParam(2, $idSubasta);
        $sql->execute();
        $elemento = $sql->fetch(PDO::FETCH_ASSOC);
        return $elemento;
    } catch (PDOException $e) {
        return null;
    }
    $conn = null;
}

/**
 * numPersonasPuja cuenta las personas participando en una puja
 *
 * @param  mixed $idSubasta
 * @return void
 */
function numPersonasPuja($idSubasta)
{

    try {
        $conn = crearConexion();

        $sql = $conn->prepare("SELECT COUNT(DISTINCT dni_cliente) AS clientes
                                FROM clientepuja
                                WHERE id_subasta = ?");
        $sql->bindParam(1, $idSubasta);
        $sql->execute();
        $elemento = $sql->fetch(PDO::FETCH_ASSOC);
        return $elemento;
    } catch (PDOException $e) {
        return null;
    }
    $conn = null;
}


/**
 * borrarObra elimina una obra
 *
 * @param  mixed $id
 * @return void
 */
function borrarObra($id)
{

    try {
        $conn = crearConexion();
        $consulta = $conn->prepare("DELETE FROM obra WHERE id=?");
        $consulta->bindParam(1, $id);
        return $consulta->execute();
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        return false;
    }
    $conexion = null;
}

/**
 * cambiarEstadoSubasta actualiza el estado de la subasta
 *
 * @param  mixed $id
 * @param  mixed $estado
 * @return void
 */
function cambiarEstadoSubasta($id, $estado)
{

    try {
        $conn = crearConexion();

        $consulta = $conn->prepare("UPDATE subasta SET estado=:estado WHERE id=:id");

        $parametros = array(":id" => $id, ":estado" => $estado);

        return $consulta->execute($parametros);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        return false;
    }
}

/**
 * comentariosClientes muestra los comentarios de los clientes
 *
 * @param  mixed $dni
 * @return void
 */
function comentariosClientes($dni)
{

    try {
        $conn = crearConexion();

        $sql = $conn->prepare("SELECT *, c.id AS idComentario, o.id AS idObra
                                FROM clientecomentaobra c, usuarios u, obra o
                                where c.id_cliente = u.dni
                                AND c.id_obra = o.id
                                AND u.dni = ?
                                ORDER BY c.fechaComentario
                                DESC");
        $sql->bindParam(1, $dni);
        $sql->execute();
        $matriz = [];
        while ($al = $sql->fetch(PDO::FETCH_BOTH)) {
            $matriz[] = $al;
        }
        return $matriz;
    } catch (PDOException $e) {
        return null;
    }
    $conn = null;
}

/**
 * comprobarUsuario comprueba que un usuario no se repite
 *
 * @param  mixed $nombreUsuario
 * @return void
 */
function comprobarUsuario($nombreUsuario)
{

    try {
        $conexion = crearConexion();
        $consulta = $conexion->prepare("SELECT * FROM `usuarios` WHERE `nombre_usuario` LIKE :nombre_usuario");
        $parametros = array(":nombre_usuario" => $nombreUsuario);
        $consulta->execute($parametros);
        $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
        $conexion = null;
        return $resultado;
    } catch (PDOException $e) {
        return false;
    }
}

/**
 * edicionSubasta edita una subasta
 *
 * @param  mixed $id
 * @param  mixed $descripcion
 * @return void
 */
function edicionSubasta($id, $descripcion)
{

    try {
        $conn = crearConexion();


        $consulta = $conn->prepare("UPDATE subasta SET descripcion=:descripcion WHERE id=:id");

        $parametros = array(
            ":id" => $id, ":descripcion" => $descripcion
        );

        return $consulta->execute($parametros);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        return false;
    }
}

/**
 * borrarSubasta elimina una subasta
 *
 * @param  mixed $id
 * @return void
 */
function borrarSubasta($id)
{

    try {
        $conn = crearConexion();
        $consulta = $conn->prepare("DELETE FROM subasta WHERE id=?");
        $consulta->bindParam(1, $id);
        return $consulta->execute();
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        return false;
    }
    $conexion = null;
}


/**
 * ganadorSubasta añade el ganador de una subasta
 *
 * @param  mixed $id
 * @param  mixed $idGanador
 * @return void
 */
function ganadorSubasta($id, $idGanador)
{

    try {
        $conn = crearConexion();

        $consulta = $conn->prepare("UPDATE subasta SET idGanador=:idGanador WHERE id=:id");

        $parametros = array(":id" => $id, ":idGanador" => $idGanador);

        return $consulta->execute($parametros);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        return false;
    }
}

/**
 * subastaGanador muestra el ganador de la subasta
 *
 * @param  mixed $dni
 * @return void
 */
function subastaGanador($dni)
{

    try {
        $conn = crearConexion();

        $sql = $conn->prepare("SELECT *, o.nombreObra AS nombreObra, s.id AS idSubasta
                                FROM artistas a, obra o, subasta s, usuarios u
                                WHERE a.dni_art = o.dni_art
                                AND u.dni = a.dni_art
                                AND o.id = s.id_obra
                                AND s.estado = 'finalizado'
                                AND s.idGanador = ?");
        $sql->bindParam(1, $dni);
        $sql->execute();
        $matriz = [];
        while ($al = $sql->fetch(PDO::FETCH_BOTH)) {
            $matriz[] = $al;
        }
        return $matriz;
    } catch (PDOException $e) {
        return null;
    }
    $conn = null;
}
