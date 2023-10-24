<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_GET['reservation']) {
    include('bdd.php');
    $remove = $bdd->prepare('DELETE FROM reservations WHERE annulation = :annulation');
    $remove->execute(array('annulation' => $_GET['reservation']));
    $remove->closeCursor();
} else {
    header('Location : index.php');
}
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <title>Annulation de réservation</title>
</head>

<body>
    <div id="logo">
        <a href="accueil.html">
            <img src="./img/Favicon_edited.png.webp" alt="logo" style="max-width: 100%; height: auto;">
        </a>
    </div>

    <h1>Votre réservation a bien été annulée. A très bientôt !</h1>
</body>

</html>