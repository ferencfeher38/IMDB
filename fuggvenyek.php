<?php

function imdb_csatlakozas() {
	
	$conn = mysqli_connect("localhost", "root", "") or die("Csatlakozási hiba");
	if ( false == mysqli_select_db($conn, "imdb")  ) {
		
		return null;
    }
    
	mysqli_query($conn, 'SET NAMES UTF-8');
	mysqli_query($conn, 'SET character_set_results=utf8');
	mysqli_set_charset($conn, 'utf8');
	
	return $conn;
	
}

function filmstudiot_beszur($studio_name, $country, $studio_date) {
	
	if ( !($conn = imdb_csatlakozas()) ) {
		return false;
	}

	$stmt = mysqli_prepare( $conn,"INSERT INTO film_studio(studio_name, country, studio_date) VALUES(?,?,?)");
	
	mysqli_stmt_bind_param($stmt, "ssd", $studio_name, $country, $studio_date);
	
	$sikeres = mysqli_stmt_execute($stmt); 
		
	mysqli_close($conn);
	return $sikeres;
}

function filmet_beszur($film_name, $director, $film_date, $studio_name) {
	
	if ( !($conn = imdb_csatlakozas()) ) {
		return false;
	}

	$stmt = mysqli_prepare( $conn,"INSERT INTO film(film_name, director, film_date, studio_name) VALUES (?, ?, ?, ?)");
	
	mysqli_stmt_bind_param($stmt, "ssds", $film_name, $director, $film_date, $studio_name);
	
	$sikeres = mysqli_stmt_execute($stmt); 
		
	mysqli_close($conn);
	return $sikeres;
}

function szineszt_beszur($actor_name, $year_of_birth) {
	
	if ( !($conn = imdb_csatlakozas()) ) {
		return false;
	}

	$stmt = mysqli_prepare( $conn,"INSERT INTO actor(actor_name, year_of_birth) VALUES (?, ?)");
	
	mysqli_stmt_bind_param($stmt, "sd", $actor_name, $year_of_birth);
	
	$sikeres = mysqli_stmt_execute($stmt); 
		
	mysqli_close($conn);
	return $sikeres;
}

function szereplest_beszur($film_name, $actor_name) {
	
	if ( !($conn = imdb_csatlakozas()) ) {
		return false;
	}

	$stmt = mysqli_prepare( $conn,"INSERT INTO performance(film_name, actor_name) VALUES (?, ?)");
	
	mysqli_stmt_bind_param($stmt, "ss", $film_name, $actor_name);
	
	$sikeres = mysqli_stmt_execute($stmt); 
		
	mysqli_close($conn);
	return $sikeres;
}

function filmstudiok_listat_leker() {
	
	if ( !($conn = imdb_csatlakozas()) ) {
		return false;
	}

	$result = mysqli_query( $conn,"SELECT * FROM film_studio ORDER BY studio_name ASC");
	
	mysqli_close($conn);
	return $result;
}

function filmek_listat_leker() {
	
	if ( !($conn = imdb_csatlakozas()) ) {
		return false;
	}

	$result = mysqli_query( $conn,"SELECT film.film_name, film.director, film.film_date, film_studio.studio_name FROM film LEFT JOIN film_studio ON film.studio_name=film_studio.studio_name ORDER BY film.film_name");
	
	mysqli_close($conn);
	return $result;
}

function szineszek_listat_leker() {
	
	if ( !($conn = imdb_csatlakozas()) ) {
		return false;
	}

	$result = mysqli_query( $conn,"SELECT * FROM actor ORDER BY actor_name ASC");
	
	mysqli_close($conn);
	return $result;
}

function szereplesek_listat_leker() {
	
	if ( !($conn = imdb_csatlakozas()) ) {
		return false;
	}

	$result = mysqli_query( $conn,"SELECT performance.film_name, performance.actor_name, actor.year_of_birth FROM performance LEFT JOIN actor ON performance.actor_name=actor.actor_name ORDER BY actor.actor_name");
	
	mysqli_close($conn);
	return $result;
}


function studio_neveket_listaz()  {

	if ( !($conn = imdb_csatlakozas()) ) {
		return false;
	}

	$result  = mysqli_query( $conn, "SELECT studio_name FROM  film_studio ORDER BY studio_name ASC");

	mysqli_close($conn);
	return $result;
}

function film_neveket_listaz()  {

	if ( !($conn = imdb_csatlakozas()) ) {
		return false;
	}

	$result  = mysqli_query( $conn, "SELECT film_name FROM  film ORDER BY film_name ASC");

	mysqli_close($conn);
	return $result;
}

function szinesz_neveket_listaz()  {

	if ( !($conn = imdb_csatlakozas()) ) {
		return false;
	}

	$result  = mysqli_query( $conn, "SELECT actor_name FROM  actor ORDER BY actor_name ASC");

	mysqli_close($conn);
	return $result;
}

function legfiatalabb_szineszeket_listaz()  {

	if ( !($conn = imdb_csatlakozas()) ) {
		return false;
	}

	$result  = mysqli_query( $conn, "SELECT * FROM  actor ORDER BY year_of_birth DESC LIMIT 5");

	mysqli_close($conn);
	return $result;
}

function legujabb_filmeket_listaz()  {

	if ( !($conn = imdb_csatlakozas()) ) {
		return false;
	}

	$result  = mysqli_query( $conn, "SELECT film.film_name, film.director, film.film_date, film_studio.studio_name FROM film LEFT JOIN film_studio ON film.studio_name=film_studio.studio_name ORDER BY film.film_date DESC LIMIT 5");

	mysqli_close($conn);
	return $result;
}

function legujabb_filmstudiot_listaz()  {

	if ( !($conn = imdb_csatlakozas()) ) {
		return false;
	}

	$result  = mysqli_query( $conn, "SELECT studio_name, country, studio_date FROM film_studio WHERE studio_date = (SELECT MAX(studio_date) FROM film_studio) LIMIT 1");

	mysqli_close($conn);
	return $result;
}



function filmstudio_torlese($studio_name) {

	if ( !($conn = imdb_csatlakozas()) ) {
		return false;
	}

	$stmt = mysqli_prepare( $conn,"DELETE FROM film_studio WHERE studio_name=?");

	mysqli_stmt_bind_param($stmt, "s", $studio_name);
	
	$sikeres = mysqli_stmt_execute($stmt); 

	mysqli_close($conn);
	return $sikeres;
}

function film_torlese($film_name) {

	if ( !($conn = imdb_csatlakozas()) ) {
		return false;
	}

	$stmt = mysqli_prepare( $conn,"DELETE FROM film WHERE film_name=?");

	mysqli_stmt_bind_param($stmt, "s", $film_name);
	
	$sikeres = mysqli_stmt_execute($stmt); 

	mysqli_close($conn);
	return $sikeres;
}

function szinesz_torlese($actor_name) {

	if ( !($conn = imdb_csatlakozas()) ) {
		return false;
	}

	$stmt = mysqli_prepare( $conn,"DELETE FROM actor WHERE actor_name=?");

	mysqli_stmt_bind_param($stmt, "s", $actor_name);
	
	$sikeres = mysqli_stmt_execute($stmt); 

	mysqli_close($conn);
	return $sikeres;
}

function szereples_torlese($actor_name) {

	if ( !($conn = imdb_csatlakozas()) ) {
		return false;
	}

	$stmt = mysqli_prepare( $conn,"DELETE FROM performance WHERE actor_name=?");

	mysqli_stmt_bind_param($stmt, "s", $actor_name);
	
	$sikeres = mysqli_stmt_execute($stmt); 

	mysqli_close($conn);
	return $sikeres;
}

?>