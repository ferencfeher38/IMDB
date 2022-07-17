<?php

include_once('fuggvenyek.php');

$toroltszereples= $_POST["toroltszereples"];


if ( isset($toroltszereples) ) {
	
	$sikeres = szereples_torlese($toroltszereples);
	
	if ( $sikeres ) {
		header('Location: szereplesek.php');
	} else {
		echo 'Hiba történt a szereplés törlése során';
	}
	
} else {
	echo 'Hiba történt a szereplés törlése során';
	
}

?>