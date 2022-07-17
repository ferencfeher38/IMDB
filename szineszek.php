<?php 
include_once('menu.php');
include_once('fuggvenyek.php');
?>
<!DOCTYPE HTML>
<HTML>
<HEAD>
	<meta http-equiv="content-type" content="text/html; charset=UTF8" >
    <link rel='stylesheet' type='text/css' href='stlye.css'/>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&family=Playfair+Display&display=swap" rel="stylesheet">
</HEAD>
<BODY>

<h1>IMDB</h1>
<?php
echo menu();
?>

<h2 class="customh2_01">Színészek felvitele</h2>

<form method="POST" action="" accept-charset="utf-8">
    <label>Színész neve: </label>
    <input type="text" name="actor_name" />
    <label>Színész születési éve: </label>
    <input type="text" name="year_of_birth" />
    <br>
    <input class="button" type="submit" formaction="szineszfelvitel.php" value="Felvitel" />
    <input class="button" name="update" type="submit" value="Módosítás" />
    <input class="button" name="delete" type="submit" value="Törlés" />
</form>

<h2>Az 5 legfiatalabb színész</h2>

<table align="center">
<tr>
<th>Színész</th>
<th>Születési év</th>
</tr>

<?php

	$legfiatalabbszineszek = legfiatalabb_szineszeket_listaz();
	
    while( $egySor = mysqli_fetch_assoc($legfiatalabbszineszek) ) { 
		echo '<tr>';
        echo '<td>'. $egySor["actor_name"] .'</td>';
        echo '<td>'. $egySor["year_of_birth"] .'</td>';
		echo '</tr>';
	} 
	mysqli_free_result($legfiatalabbszineszek);

?>
</table>

<h2 class="customh2_02">Színészek listája</h2>

<table align="center">
<tr>
<th>Színész</th>
<th>Születési év</th>
</tr>

<?php

	$szineszek = szineszek_listat_leker();
	
    while( $egySor = mysqli_fetch_assoc($szineszek) ) { 
		echo '<tr>';
        echo '<td>'. $egySor["actor_name"] .'</td>';
        echo '<td>'. $egySor["year_of_birth"] .'</td>';
        echo '<td><form method="POST" action="szinesztorlese.php">
                  <input type="hidden" name="toroltszinesz" value="'.$egySor["actor_name"].'" />
                  <input class="button" type="submit" value="Törlés" />
                  </form></td>';
		echo '</tr>';
	} 
	mysqli_free_result($szineszek);

?>
</table>

<?php
if ( !($conn = imdb_csatlakozas()) ) {
    return false;
}

if(isset($_POST['update'])) {
    $actor_name = $_POST['actor_name'];
    $query = "UPDATE actor SET year_of_birth='$_POST[year_of_birth]' WHERE actor_name='$_POST[actor_name]'";
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
    $actor_name = $_POST['actor_name'];
    $query = "DELETE FROM actor WHERE actor_name='$_POST[actor_name]'";
    $query_run = mysqli_query($conn,$query);
    
    if($query_run) {
    } else {
        echo 'Sikertelen törlés.';
    }
}
?>

</BODY>
</HTML>