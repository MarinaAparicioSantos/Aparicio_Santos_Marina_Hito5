<?php

require "obrasModel.php";

/**
 * usuario selecciona los datos de un usuario
 *
 * @param  mixed $nombre_usuario
 * @return void
 */
function usuario($nombre_usuario)
{

    try {
        $conexion = crearConexion();
        $consulta = $conexion->prepare("SELECT `dni`, `contrasenya`, `nombre_usuario` FROM `usuarios` WHERE `nombre_usuario` LIKE :nombre_usuario");
        $parametros = array(":nombre_usuario" => $nombre_usuario);
        $consulta->execute($parametros);
        $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
        $conexion = null;
        return $resultado;
    } catch (PDOException $e) {
        return false;
    }
}

/**
 * tipoUsuario selecciona el tipo de usuario
 *
 * @param  mixed $dni
 * @return void
 */
function tipoUsuario($dni)
{

    try {
        $conexion = crearConexion();
        $consulta = $conexion->prepare("SELECT tipo FROM `usuarios` WHERE `dni` = :dni");
        $parametros = array(":dni" => $dni);
        $consulta->execute($parametros);
        $resultado = $consulta->fetch();
        $conexion = null;
        return $resultado;
    } catch (PDOException $e) {
        return false;
    }
}

/**
 * cambioContrasenya hace que un usuario pueda cambiar su contraseña
 *
 * @param  mixed $dni
 * @param  mixed $contrasenya
 * @return void
 */
function cambioContrasenya($dni, $contrasenya){

    try {
        $conn = crearConexion();


        $consulta = $conn->prepare("UPDATE usuarios SET contrasenya=:contrasenya 
         WHERE dni=:dni");

        $parametros = array(
            ":dni" => $dni, ":contrasenya" => $contrasenya
        );

        return $consulta->execute($parametros);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        return false;
    }

}


/**
 * dniContrasenya selecciona el dni y la contraseña de los usuarios
 *
 * @param  mixed $dni
 * @return void
 */
function dniContrasenya($dni)
{

    try {
        $conexion = crearConexion();
        $consulta = $conexion->prepare("SELECT `dni`, `contrasenya` FROM `usuarios` WHERE `dni` LIKE :dni");
        $parametros = array(":dni" => $dni);
        $consulta->execute($parametros);
        $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
        $conexion = null;
        return $resultado;
    } catch (PDOException $e) {
        return false;
    }
}