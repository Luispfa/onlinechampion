
<?php

require_once 'entity/equipo.php';

class equipoController {

    public function __construct() {
        
    }

    public function main($action, $team, $newname) {
       
        $equipo = new equipo($team);

        switch ($action) {
            case 'show';
                $resp = $equipo->showJugadores();
                break;
            case 'update';
                $resp = $equipo->updateEquipo($newname);
                break;

            default:
                break;
        }
        return $resp;
    }

}
