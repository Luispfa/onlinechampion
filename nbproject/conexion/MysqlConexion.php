<?php

//namespace conexion;

class MysqlConexion {


    /**
     * Establece la conexion a la BD
     * @return array
     * @throws Exception
     */
    public static function Conexion() {

        //Variables locales
        $cn = NULL;
        $db = NULL;
        try {
            
            $cn = @mysql_connect('localhost','root', 'root');
            
            mysql_query("SET NAMES 'utf8'");
            
            if (mysql_error())
                throw new Exception(mysql_error());

            $db = @mysql_select_db('onlinechampion', $cn);

            if (mysql_error())
                throw new Exception(mysql_error());

            return $cn;
        } catch (Exception $e) {
            
            return mysql_error();
        }
    }

    /**
     * Ejecuta una Query devuelve un conjunto de valores
     * @param object $cn
     * @param string $sql
     * @return array
     * @throws Exception
     */
    public static function EjecutarConsulta($cn, $sql) {
        //Variables locales
        $rs = NULL;
        try {
            $rs = @mysql_query($sql, $cn);
            if (mysql_error())
                throw new Exception(mysql_error());

            return $rs;
        } catch (Exception $e) {
            
            return mysql_error();
        }
    }

    /**
     * Ejecuta una Query Devuelve solo un valor
     * @param object $cn
     * @param string $sql
     * @return array
     * @throws Exception
     */
    public static function EjecutarConsultaScalar($cn, $sql) {
        //Variables locales
        $rs = NULL;
        $v = NULL;
        try {
            $rs = @mysql_query($sql, $cn);
            if (mysql_error())
                throw new Exception(mysql_error());

            $value = @mysql_result($rs, 0, 0);
            if (mysql_error())
                throw new Exception(mysql_error());

            return $value;
        } catch (Exception $e) {
            
            return mysql_error();
        }
    }

    /**
     * Ejecuta una Query de tipo Insert, Delete, Update u otro que no devuelven registros.
     * devuelve el numero de registros afectados
     * @param object $cn
     * @param string $sql
     * @return array
     * @throws Exception
     */
    public static function EjecutarNoConsulta($cn, $sql) {
        //Variables locales
        $rs = NULL;
        try {
            $ok = @mysql_query($sql, $cn);
            if (mysql_error())
                throw new Exception(mysql_error());
            if (mysql_errno() == 1146)
                throw new Exception(mysql_errno());

            $num = @mysql_affected_rows();
            return $num;
        } catch (Exception $e) {
            
            return mysql_error();
        }
    }

    /**
     * Ejecuta una Query de tipo Insert, devuelve ID
     * @param object $cn
     * @param string $sql
     * @return array
     * @throws Exception
     */
    public static function EjecutarInsert($cn, $sql) {
        //Variables locales
        $rs = NULL;
        try {
            $ok = @mysql_query($sql, $cn);
            $id = mysql_insert_id();
            if (mysql_error())
                throw new Exception(mysql_error());


            return $id;
        } catch (Exception $e) {
            error_log("\n" . date("Y/m/d H:i:s") . '  -  ' . $e->getMessage() . ' IN ' . $sql, 3, PATH . "/error/errors.log");
            return mysql_error();
        }
    }

    //Iniciar Transacci�n
    public static function IniciarTransaccion($cn) {
        //Variables locales
        $rs = NULL;
        try {
            @mysql_query("BEGIN", $cn);
            if (mysql_error())
                throw new Exception(mysql_error());
        } catch (Exception $e) {
            
            throw new Exception("No se pudo iniciar la transacci�n");
        }
    }

    //Confirmar y Terminar la Transacci�n
    public static function ConfirmarTransaccion($cn) {
        //Variables locales
        $rs = NULL;
        try {
            @mysql_query("COMMIT", $cn);
            if (mysql_error())
                throw new Exception(mysql_error());
        } catch (Exception $e) {
            
            throw new Exception("No se pudo confirmar la transacci�n");
        }
    }

    //Cancelar y Terminar la Transacci�n
    public static function CancelarTransaccion($cn) {
        //Variables locales
        $rs = NULL;
        try {
            @mysql_query("ROLLBACK", $cn);
            if (mysql_error())
                throw new Exception(mysql_error());
        } catch (Exception $e) {
            
            throw new Exception("No se pudo cancelar la transacci�n");
        }
    }

}

?>