<?php 
include_once('menu.php');
include_once('fuggvenyek.php');
?>
<!DOCTYPE HTML>
<HTML>
<HEAD>
	<meta http-equiv="content-type" content="text/html; charset=UTF8" >
    <link rel='stylesheet' type='text/css' href='style.css'/>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&family=Playfair+Display&display=swap" rel="stylesheet">
</HEAD>
<BODY>

<h1>IMDB</h1>

<?php
echo menu();
?>

<h2 class="customh2_01">Filmstúdiók felvitele</h2>

<form method="POST" action="" accept-charset="utf-8">
   <label>Filmstúdió neve: </label>
   <input type="text" name="studio_name" />
   <label>Ország: </label>
   <input type="text" name="country" />
   <label>Alapítási év: </label>
   <input type="text" name="studio_date" />
   <br>
   <input class="button" formaction="filmstudio_felvitel.php"  type="submit" value="Felvitel" />
   <input class="button" name="update" type="submit" value="Módosítás" />
   <input class="button" name="delete" type="submit" value="Törlés" />
</form>

<h2>A legújabb filmstúdió</h2>

<table align="center">
<tr>
<th>Filmstúdió</th>
<th>Ország</th>
<th>Alapítási év</th>
</tr>

<?php

	$filmstudio = legujabb_filmstudiot_listaz();
	
    while( $egySor = mysqli_fetch_assoc($filmstudio) ) { 
		echo '<tr>';
        echo '<td>'. $egySor["studio_name"] .'</td>';
        echo '<td>'. $egySor["country"] .'</td>';
        echo '<td>'. $egySor["studio_date"] .'</td>';
		echo '</tr>';
	} 
	mysqli_free_result($filmstudio);

?>
</table>

<h2 class="customh2_02">Filmstúdiók listája</h2>

<table align="center">
<tr>
<th>Filmstúdió</th>
<th>Ország</th>
<th>Alapítási év</th>
</tr>

<?php

	$filmstudiok = filmstudiok_listat_leker();
	
    while( $egySor = mysqli_fetch_assoc($filmstudiok) ) { 
		echo '<tr>';
        echo '<td>'. $egySor["studio_name"] .'</td>';
        echo '<td>'. $egySor["country"] .'</td>';
        echo '<td>'. $egySor["studio_date"] .'</td>';
        echo '<td><form method="POST" action="filmstudiotorlese.php">
                  <input type="hidden" name="toroltstudio" value="'.$egySor["studio_name"].'" />
				  <input class="button" type="submit" value="Törlés" />
                  </form></td>';
		echo '</tr>';
	} 
	mysqli_free_result($filmstudiok);

?>
<?php

if ( !($conn = imdb_csatlakozas()) ) {
    return false;
}


if(isset($_POST['update'])) {
    $studio_name = $_POST['studio_name'];
    $query = "UPDATE film_studio SET country='$_POST[country]', studio_date='$_POST[studio_date]' WHERE studio_name='$_POST[studio_name]'";
    $query_run = mysqli_query($conn,$query);
    
    if($query_run) {
    } else {
        echo 'Sikertelen módosítás.';
    }
}

?>
<?php

if ( !($conn = imdb_csatlakozas()) ) {
    return false;
}


if(isset($_POST['delete'])) {
    $studio_name = $_POST['studio_name'];
    $query = "DELETE FROM film_studio WHERE studio_name='$_POST[studio_name]'";
    $query_run = mysqli_query($conn,$query);
    
    if($query_run) {
    } else {
        echo 'Sikertelen törlés.';
    }
}
?>
</table>
</BODY>
</HTML>