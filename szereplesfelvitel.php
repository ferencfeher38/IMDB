<?php

include_once("fuggvenyek.php");

$v_film_name = $_POST['film_name'];
$v_actor_name = $_POST['actor_name'];

if ( isset($v_film_name) && isset($v_actor_name) ) {

    szereplest_beszur($v_film_name, $v_actor_name);
    
    header("Location: szereplesek.php");

} else {
	error_log("Nincs beállítva valamely érték");
}

?>