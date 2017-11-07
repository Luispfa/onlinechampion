<?php

require 'equipoInteger.php';
require 'equipoString.php';

abstract class equipoAbstract {

    const INTEGER = 'integer';
    const STRING = 'string';

    public function getEquipo($param) {
        $data_type = gettype($param);
        switch ($data_type) {
            case self::INTEGER:
                return new equipoInteger($param);
                break;
            case self::STRING:
                return new equipoString($param);
                break;
            default:
                return null;
        }
    }

}
