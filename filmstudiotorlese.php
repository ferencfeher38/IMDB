<?php

include_once('fuggvenyek.php');

$toroltstudio= $_POST["toroltstudio"];


if ( isset($toroltstudio) ) {
	
	$sikeres = filmstudio_torlese($toroltstudio);
	
	if ( $sikeres ) {
		header('Location: filmstudiok.php');
	} else {
		echo 'Hiba történt a filmstúdió törlése során';
	}
	
} else {
	echo 'Hiba történt a filmstúdió törlése során';
	
}

?>