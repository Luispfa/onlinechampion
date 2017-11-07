<?php

interface jugadoresInterface {

    public function getId();

    public function existeEquipo();

    public function existRecord();

    public function getJugadores();

    public function update($nuevo_nombre);
}
