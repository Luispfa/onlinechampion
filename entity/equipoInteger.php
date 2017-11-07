<?php

//namespace entity;
//use conexion\MysqlQuery;
require_once 'conexion/MysqlQuery.php';
require_once 'repositoryAbstract.php';
require_once 'jugadoresInterface.php';

class equipoInteger extends repositoryAbstract implements jugadoresInterface {

    private $id = 0;
    private $jugadores = array();

    public function __construct($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function existeEquipo() {
        return $this->existRecord();
    }

    public function existRecord() {
        $cn = new MysqlQuery();
        $rows = $cn->ExecuteNumRows(str_replace("{id}", $this->id, $this->queryGetEquipoById()));

        return $rows;
    }

    public function getJugadores() {
        if ($this->existeEquipo()) {
            $cn = new MysqlQuery();

            $sql = str_replace("{equipo}", $this->id, $this->queryGetJugadores());
            $result = $cn->ExecuteSelect($sql);
            $usuarios=array();
            while ($row = mysql_fetch_assoc($result)) {
                $usuarios[] = $row;
            }

            $sql = str_replace("{id}", $this->id, $this->queryGetEquipoById());
            $nombre = $cn->ExecuteScalar($sql);

            $this->jugadores[$nombre] = $usuarios;
        }
        return $this->jugadores;
    }

    public function update($nuevo_nombre) {
        $sql = str_replace("{newnombre}", $nuevo_nombre, $this->updateEquipoById());
        $sql = str_replace("{id}", $this->id, $sql);

        $cn = new MysqlQuery();
        $affected_rows = $cn->ExecuteNoSelect($sql);

        return $affected_rows;
    }

}
