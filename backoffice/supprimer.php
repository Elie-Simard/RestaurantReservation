<?php
if($_GET['reservation']){
    include('../bdd.php');
    $remove = $bdd->prepare('DELETE FROM reservations WHERE annulation = :annulation');
    $remove->execute(array('annulation' => $_GET['reservation']));
    $remove->closeCursor();
}
header('Location: index.php');
?>