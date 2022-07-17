<?php

include_once('fuggvenyek.php');

$toroltfilm= $_POST["toroltfilm"];


if ( isset($toroltfilm) ) {
	
	$sikeres = film_torlese($toroltfilm);
	
	if ( $sikeres ) {
		header('Location: filmek.php');
	} else {
		echo 'Hiba történt a film törlése során';
	}
	
} else {
	echo 'Hiba történt a film törlése során';
	
}

?>