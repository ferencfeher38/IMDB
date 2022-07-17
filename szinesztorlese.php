<?php

include_once('fuggvenyek.php');

$toroltszinesz= $_POST["toroltszinesz"];


if ( isset($toroltszinesz) ) {
	
	$sikeres = szinesz_torlese($toroltszinesz);
	
	if ( $sikeres ) {
		header('Location: szineszek.php');
	} else {
		echo 'Hiba történt a színész törlése során';
	}
	
} else {
	echo 'Hiba történt a színész törlése során';
	
}

?>