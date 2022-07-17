<?php
echo "<link rel='stylesheet' type='text/css' href='style.css' />";

function menu() {
    $menustr   = '<div class="menu">';
    $menustr  .= '<a class="menuopt" href="index.php">Főoldal</a>';
    $menustr  .= '<a class="menuopt" href="filmstudiok.php">Filmstúdiók</a>';
    $menustr  .= '<a class="menuopt" href="filmek.php">Filmek</a>';
    $menustr  .= '<a class="menuopt" href="szineszek.php">Színészek</a>';
    $menustr  .= '<a class="menuopt" href="szereplesek.php">Szereplések</a>';
    $menustr  .= '</div>';
    return $menustr;
}

?>

