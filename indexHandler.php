
<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

//use entity\equipo;
require_once 'controller/equipoController.php';

$action = $_POST['action'];
$team = is_numeric($_POST['team']) ? $_POST['team'] * 1 : $_POST['team'];
$newname = $_POST['newname'];


$controller = new equipoController();
$equipo = $controller->main($action, $team, $newname);

echo json_encode($equipo);
?>
