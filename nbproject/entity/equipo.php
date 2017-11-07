<?php

//namespace entity;
//use conexion\MysqlQuery;

require 'equipoAbstract.php';

class equipo extends equipoAbstract {

    private $equipo;

    //private $id = 0;
    //private $nombre = null;
    //private $jugadores;

    public function __construct($param) {
        $this->equipo = $this->getEquipo($param);
    }
    
    public function showJugadores() {
        return $this->equipo->getJugadores();
    }
    
    public function updateEquipo($nuevo_nombre) {
        return $this->equipo->update($nuevo_nombre);
    }
    
    


}
