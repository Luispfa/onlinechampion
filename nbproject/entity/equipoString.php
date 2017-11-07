<?php

//namespace entity;
//use conexion\MysqlQuery;
require_once 'conexion/MysqlQuery.php';
require_once 'repositoryAbstract.php';
require_once 'jugadoresInterface.php';

class equipoString extends repositoryAbstract implements jugadoresInterface {

    //private $id = 0;
    private $nombre = null;
    private $jugadores = array();

    public function __construct($nombre) {
        $this->nombre = $nombre;
    }

    public function getId() {
        $cn = new MysqlQuery();
        $id = $cn->ExecuteScalar(str_replace("{nombre}", $this->nombre, $this->queryGetIdEquipoByName()));

        return $id;
    }

    public function existeEquipo() {
        return $this->existRecord();
    }

    public function existRecord() {
        $cn = new MysqlQuery();
        $rows = $cn->ExecuteNumRows(str_replace("{nombre}", $this->nombre, $this->queryGetIdEquipoByName()));

        return $rows;
    }

    public function getJugadores() {
        if ($this->existeEquipo()) {
            $sql = str_replace("{equipo}", $this->getId(), $this->queryGetJugadores());

            $cn = new MysqlQuery();
            $result = $cn->ExecuteSelect($sql);
            $usuarios=array();
            while ($row = mysql_fetch_assoc($result)) {
                $usuarios[] = $row;
            }
            
            $sql = str_replace("{id}", $this->getId(), $this->queryGetEquipoById());
            $nombre = $cn->ExecuteScalar($sql);

            $this->jugadores[$nombre] = $usuarios;
        
        }
        return $this->jugadores;
    }

    public function update($nuevo_nombre) {
        $sql = str_replace("{newname}", $nuevo_nombre, $this->updateEquipoByName());
        $sql = str_replace("{oldname}", $this->nombre, $sql);
        $cn = new MysqlQuery();
        $affected_rows = $cn->ExecuteNoSelect($sql);

        return $affected_rows;
    }

}
