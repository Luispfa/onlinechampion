<?php

//namespace conexion;

/** Clase abstracta para el manejo de datos en tablas
 * @author: Luis Flores; 
 * @version 3.0 2008-12-17
 */
require 'MysqlConexion.php';

class MysqlQuery {


    /**
     * * $table Nombre de la tabla que se manejará por esta instancia
     */
    public function __construct() {
        
    }

    ////////Public Methods

    /** ejecuta ResultSet y devuelve un array de objetos
     * @param $rs
     * @return array
     */
    public function GetObject($rs) {
        if ($rs['response'] == 'ok') {
            $array = array();
            while ($row = mysql_fetch_object($rs['main'])) {
                $array[] = $row;
            }
            $rs['main'] = $array;
        }
        return $rs;
    }

    /** ejecuta ResultSet y devuelve un array numerico
     * @param $rs
     * @return array
     */
    public function GetArray($rs) {
        if ($rs['response'] == 'ok') {
            $array = array();
            while ($row = mysql_fetch_array($rs['main'])) {
                $array[] = $row;
            }
            $rs['main'] = $array;
        }
        return $rs;
    }

    /* public function validateOperation() {
      return mysql_error() == '' ? true : false;
      } */

    public function GetRows($rs) {
        $resultado = array();
        if ($rs) {
            while ($rows = mysql_fetch_assoc($rs))
                array_push($resultado, $rows);
        }
        return $resultado;
    }

    /** ejecuta DELETE UPDATE, Create */
    public function ExecuteNoSelect($sql = NULL) {
        $rs = NULL;
        $cn = NULL;
        try {
            $cn = MysqlConexion::Conexion();
            $rs = MysqlConexion::EjecutarNoConsulta($cn, $sql);
            mysql_close($cn);
            return $rs;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function ExecuteExistTable($table) {
        $rs = NULL;
        $cn = NULL;
        try {
            $cn = MysqlConexion::Conexion();
            $sql = 'SHOW TABLES LIKE "' . $table . '"';
            $rs = MysqlConexion::EjecutarConsultaScalar($cn, $sql);
            mysql_close($cn);
            return $rs;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /** ejecuta INSERT */
    public function ExecuteInsert($sql = NULL) {
        $rs = NULL;
        $cn = NULL;
        try {
            $cn = MysqlConexion::Conexion();
            $rs = MysqlConexion::EjecutarInsert($cn, $sql);
            mysql_close($cn);
            return $rs;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /** ejecuta devuelve un valor */
    public function ExecuteScalar($sql = NULL) {
        $rs = NULL;
        $cn = NULL;
        try {
            $cn = MysqlConexion::Conexion();
            $rs = MysqlConexion::EjecutarConsultaScalar($cn, $sql);
            mysql_close($cn);
            return $rs;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /** ejecuta SELECT */
    public function ExecuteSelect($sql = NULL) {
      
        $rs = NULL;
        $cn = NULL;
        try {
            $cn = MysqlConexion::Conexion();
            $rs = MysqlConexion::EjecutarConsulta($cn, $sql);
            mysql_close($cn);
            return $rs;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /** ejecuta SELECT */
    public function ExecuteNumRows($sql = NULL) {
        
        $rs = NULL;
        $cn = NULL;
        try {
            $cn = MysqlConexion::Conexion();
            $rs = MysqlConexion::EjecutarConsulta($cn, $sql);
                      
            $rows = mysql_num_rows($rs);
            mysql_close($cn);
            return $rows;
        } catch (Exception $e) {
            throw $e;
        }
    }


}

?>