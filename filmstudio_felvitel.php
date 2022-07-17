<?php

include_once("fuggvenyek.php");

$v_studio_name = $_POST['studio_name'];
$v_country = $_POST['country'];
$v_studio_date = $_POST['studio_date'];

if ( isset($v_studio_name) && isset($v_country) && isset($v_studio_date) ) {

	filmstudiot_beszur($v_studio_name, $v_country, $v_studio_date);

	header("Location: filmstudiok.php");

} else {
	error_log("Nincs beállítva valamely érték");
}