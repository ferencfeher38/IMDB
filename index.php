<?php 
include_once('menu.php');
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

<form class="search" method="post">
<label>Kereső: </label>
<input class="searchinput" type="text" name="search">
<input class="button" type="submit" name="submit"  value="Keresés">	
</form>

<?php
$con = new PDO("mysql:host=localhost;dbname=imdb",'root','');

if (isset($_POST["submit"])) {
	$str = $_POST["search"];
    $sth = $con->prepare("SELECT * FROM film_studio WHERE studio_name = '$str'");
    $sth1 = $con->prepare("SELECT * FROM actor WHERE actor_name = '$str'");
    $sth2 = $con->prepare("SELECT * FROM film WHERE film_name = '$str'");

    $sth->setFetchMode(PDO:: FETCH_OBJ);
    $sth1->setFetchMode(PDO:: FETCH_OBJ);
    $sth2->setFetchMode(PDO:: FETCH_OBJ);

    $sth -> execute();
    $sth1 -> execute();
    $sth2 -> execute();

	if($row = $sth->fetch()) {
		?>
		<table align="center">
			<tr>
				<th>Filmstúdió</th>
                <th>Ország</th>
                <th>Alapítási év</th>
			</tr>
			<tr>
				<td><?php echo $row->studio_name;?></td>
                <td><?php echo $row->country;?></td>
                <td><?php echo $row->studio_date;?></td>
			</tr>
        </table>

    <?php
    } elseif($row = $sth1->fetch()) {
    ?>
        <table align="center">
			<tr>
				<th>Színész</th>
                <th>Születési év</th>
			</tr>
			<tr>
				<td><?php echo $row->actor_name;?></td>
                <td><?php echo $row->year_of_birth;?></td>
			</tr>
        </table>
    <?php
    } elseif($row = $sth2->fetch()) {
    ?>
        <table align="center">
			<tr>
				<th>Film</th>
                <th>Filmstúdió</th>
                <th>Rendező</th>
                <th>Megjelenési év</th>
			</tr>
			<tr>
				<td><?php echo $row->film_name;?></td>
                <td><?php echo $row->studio_name;?></td>
                <td><?php echo $row->director;?></td>
                <td><?php echo $row->film_date;?></td>
			</tr>
        </table>
    <?php
    } else {
	    echo '<p>Ez a név nem létezik az adatbázisban!</p>';
    }
}



?>

</BODY>
</HTML>