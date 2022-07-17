<?php

include_once("fuggvenyek.php");

$v_film_name = $_POST['film_name'];
$v_director = $_POST['director'];
$v_film_date = $_POST['film_date'];
$v_studio_name = $_POST['studio_name'];

if ( isset($v_film_name) && isset($v_director) && isset($v_film_date) && isset($v_studio_name) ) {

    filmet_beszur($v_film_name, $v_director, $v_film_date, $v_studio_name);
    
    header("Location: filmek.php");

} else {
	error_log("Nincs beállítva valamely érték");
}

?>