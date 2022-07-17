<?php

include_once("fuggvenyek.php");

$v_actor_name = $_POST['actor_name'];
$v_year_of_birth = $_POST['year_of_birth'];

if ( isset($v_actor_name) && isset($v_year_of_birth) ) {

    szineszt_beszur($v_actor_name, $v_year_of_birth);
    
    header("Location: szineszek.php");

} else {
	error_log("Nincs beállítva valamely érték");
}

?>