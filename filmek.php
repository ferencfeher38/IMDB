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

<h2 class="customh2_01">Filmek felvitele</h2>

<form method="POST" action="" accept-charset="utf-8">
    <label>Film neve: </label>
    <input type="text" name="film_name" />
    <label>Rendező: </label>
    <input type="text" name="director" />
    <label>Megjelenési év: </label>
    <input type="text" name="film_date" />
    <label>Filmstúdió: </label>
    <select style="padding: 6px" name="studio_name">
        <?php 
            $studionevek = studio_neveket_listaz();
            while( $egySor = mysqli_fetch_assoc($studionevek) ) {
                echo '<option value="'.$egySor["studio_name"].'">'.$egySor["studio_name"].'</option>';
            }
            mysqli_free_result($studionevek);
        ?>
    </select>
    <br>
    <input class="button" type="submit" formaction="filmfelvitel.php" value="Felvitel" />
    <input class="button" name="update" type="submit" value="Módosítás" />
    <input class="button" name="delete" type="submit" value="Törlés" />
</form>

<h2>A legújabb 5 film</h2>

<table align="center">
<tr>
<th>Film</th>
<th>Rendező</th>
<th>Megjelenési év</th>
<th>Filmstúdió</th>
</tr>

<?php

	$legujabbfilmek = legujabb_filmeket_listaz();
	
    while( $egySor = mysqli_fetch_assoc($legujabbfilmek) ) { 
		echo '<tr>';
        echo '<td>'. $egySor["film_name"] .'</td>';
        echo '<td>'. $egySor["director"] .'</td>';
        echo '<td>'. $egySor["film_date"] .'</td>';
        echo '<td>'. $egySor["studio_name"] .'</td>';
		echo '</tr>';
	} 
	mysqli_free_result($legujabbfilmek);

?>
</table>

<h2 class="customh2_02">Filmek listája</h2>

<table align="center">
<tr>
<th>Film</th>
<th>Rendező</th>
<th>Megjelenési év</th>
<th>Filmstúdió</th>
</tr>

<?php

	$filmek = filmek_listat_leker();
	
    while( $egySor = mysqli_fetch_assoc($filmek) ) { 
		echo '<tr>';
        echo '<td>'. $egySor["film_name"] .'</td>';
        echo '<td>'. $egySor["director"] .'</td>';
        echo '<td>'. $egySor["film_date"] .'</td>';
        echo '<td>'. $egySor["studio_name"] .'</td>';
        echo '<td><form method="POST" action="filmtorlese.php">
                  <input type="hidden" name="toroltfilm" value="'.$egySor["film_name"].'" />
                  <input class="button" type="submit" value="Törlés" />
                  </form></td>';
		echo '</tr>';
	} 
	mysqli_free_result($filmek);

?>
</table>

<?php
if ( !($conn = imdb_csatlakozas()) ) {
    return false;
}

if(isset($_POST['update'])) {
    $film_name = $_POST['film_name'];
    $query = "UPDATE film SET director='$_POST[director]', film_date='$_POST[film_date]', studio_name='$_POST[studio_name]' WHERE film_name='$_POST[film_name]'";
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
    $film_name = $_POST['film_name'];
    $query = "DELETE FROM film WHERE film_name='$_POST[film_name]'";
    $query_run = mysqli_query($conn,$query);
    
    if($query_run) {
    } else {
        echo 'Sikertelen törlés.';
    }
}
?>

</BODY>
</HTML>