<?php

abstract class repositoryAbstract {

    public function queryGetJugadores() {
        $sql = 'SELECT u.id,u.nick,s.summoner '
                . 'FROM equipos_usuarios j '
                . 'INNER JOIN usuarios u on j.idusuario=u.id'
                . ' INNER JOIN summoners s on s.idusuario = u.id '
                . 'WHERE j.idequipo={equipo} and j.aceptado = 1 ';
        return $sql;
    }

    public function updateEquipoById() {
        $sql = "UPDATE equipos SET nombre='{newnombre}' WHERE id={id}";
        return $sql;
    }

    public function updateEquipoByName() {
        $sql = "UPDATE equipos SET nombre='{newname}' WHERE nombre='{oldname}'";
        return $sql;
    }

    public function queryGetIdEquipoByName() {
        $sql = "SELECT id FROM equipos WHERE nombre='{nombre}'";
        return $sql;
    }

    public function queryGetEquipoById() {
        $sql = "SELECT nombre FROM equipos WHERE id={id}";
        return $sql;
    }

}
