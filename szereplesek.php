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

<h2 class="customh2_01">Szereplések felvitele</h2>

<form method="POST" action="" accept-charset="utf-8">
    <label>Film neve: </label>
    <select style="padding: 6px" name="film_name">
        <?php 
            $filmnevek = film_neveket_listaz();
            while( $egySor = mysqli_fetch_assoc($filmnevek) ) {
                echo '<option value="'.$egySor["film_name"].'">'.$egySor["film_name"].'</option>';
            }
            mysqli_free_result($filmnevek);
        ?>
    </select>
    <label style="margin-left: 20px">Színész neve: </label>
    <select style="padding: 6px" name="actor_name">
        <?php 
            $szinesznevek = szinesz_neveket_listaz();
            while( $egySor = mysqli_fetch_assoc($szinesznevek) ) {
                echo '<option value="'.$egySor["actor_name"].'">'.$egySor["actor_name"].'</option>';
            }
            mysqli_free_result($szinesznevek);
        ?>
    </select>
    <br>
    <input class="button" type="submit" formaction="szereplesfelvitel.php" value="Felvitel" />
    <input class="button" name="update" type="submit" value="Módosítás" />
    <input class="button" name="delete" type="submit" value="Törlés" />
</form>

<h2>Szeplések listája</h2>

<table align="center">
<tr>
<th>Színész</th>
<th>Születési év</th>
<th>Film</th>
</tr>

<?php

	$szereplesek = szereplesek_listat_leker();
	
    while( $egySor = mysqli_fetch_assoc($szereplesek) ) { 
		echo '<tr>';
        echo '<td>'. $egySor["actor_name"] .'</td>';
        echo '<td>'. $egySor["year_of_birth"] .'</td>';
        echo '<td>'. $egySor["film_name"] .'</td>';
        echo '<td><form method="POST" action="szereplestorlese.php">
                  <input type="hidden" name="toroltszereples" value="'.$egySor["actor_name"].'" />
                  <input class="button" type="submit" value="Törlés" />
                  </form></td>';
		echo '</tr>';
	} 
	mysqli_free_result($szereplesek);

?>
</table>

<?php
if ( !($conn = imdb_csatlakozas()) ) {
    return false;
}

if(isset($_POST['update'])) {
    $film_name = $_POST['film_name'];
    $query = "UPDATE performance SET actor_name='$_POST[actor_name]' WHERE film_name='$_POST[film_name]'";
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
    $film_name = $_POST['actor_name'];
    $query = "DELETE FROM performance WHERE actor_name='$_POST[actor_name]'";
    $query_run = mysqli_query($conn,$query);
    
    if($query_run) {
    } else {
        echo 'Sikertelen törlés.';
    }
}
?>

</BODY>
</HTML>