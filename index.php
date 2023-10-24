<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
$heures = '00:00';

if (!empty($_POST)) {
    extract($_POST); //creation des variables extraite du formulaire (ex: $nom)
    $validation = true; // est valide par defaut, false s'ils catchent des erreurs dans le formulaires

    list($annee, $mois, $jour) = explode('-', $date); //extrait la date dans $annee. $mois, $jour

    if ($jour < 10) {
        $jour = '0' . $jour; // ajoute 0 devant le jour (0 + jour (03))
    }
    if ($mois < 10) {
        $mois = '0' . $mois;
    }

    //-------------------------CATCHING INVALID ENTRY FUNCTION------------------------------------------//
    $date_unix = strtotime($annee . '-' . $mois . '-' . $jour); //strtotime rend la date manipulable/comparable
    if ($date_unix < time()) {
        $validation = false; //date passé
        $erreur_date = "Date invalide";
    }
    if (empty($nom)) {
        $validation = false;
        $erreur_nom = "Indiquez votre nom";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // valide le format de courriel
        $validation = false;
        $erreur_email = "Indiquez votre adresse courriel";
    }
    if ($validation) {
        include('bdd.php');
        $annulation = time() . '' . $nom; //crée une valeur unique qui sera utilisée pour générer un lien d'annulation de la réservation.
        $req = $bdd->prepare('INSERT INTO reservations (jour,couverts,nom,email,annulation) VALUES (:jour,:couverts,:nom,:email,:annulation)'); //prepare une requete a send avec des parametre nomme :jour qui prend $jour (ajoute une surface de protection aux données)
        $req->execute(
            array(
                'jour' => $annee . '-' . $mois . '-' . $jour . ' ' . $heures . ':00',
                //add à la column jour le bon format de dateSQL
                'couverts' => $couverts,
                'nom' => $nom,
                'email' => $email,
                'annulation' => $annulation
            )
        );
        $req->closeCursor(); //ferme la requeteSQL

        $to = $email; //ENVOIE D'UN EMAIL
        $subject = "Confirmation de réservation";
        $content = '
            Nous vous confirmons votre réservation dans notre restaurant.<br />
            <br />
            <strong>Jour de la réservation :</strong> ' . $jour . '/' . $mois . '/' . $annee . '<br />
            <strong>Heure de la réservation :</strong> ' . $heures . '<br />
            <strong>Nombre de couverts :</strong> ' . $couverts . '<br />
            <strong>Au nom de :</strong> ' . $nom . '<br />
            <br />
            Vous vous êtes trompé en effectuant votre réservation? Annulez-là en cliquant sur ce lien : <a href="http://127.0.0.1:81/reservation/annulation.php?reservation=' . $annulation . '">Annuler ma réservation</a><br />
            <br/>
            A très bientôt !
        ';
        $headers = 'MIME-Version: 1.0' . "\r\n"; // (Multipurpose Internet Mail Extensions)
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        mail($to, $subject, $content, $headers); //la fonction MAIL() envoie le mail
    }
    if (mail($to, $subject, $content, $headers)) {
        echo "Email sent successfully";
    } else {
        echo "Email sending failed";
    }
}
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <title>Réservation en ligne</title>
</head>

<body id="indexBody">
    <a href="menu.php">Voir le menu</a>
    <div id="logo">
        <a href="accueil.html">
            <img src="./img/Favicon_edited.png.webp" alt="logo" style="max-width: 100%; height: auto;">
        </a>
    </div>
    <?php if ((isset($validation)) && ($validation == true)) { ?> <!--check if on a recu un formulaire valide -->
        <h1>Réservation enregistrée (consultez vos e-mails)</h1>
    <?php } else { ?>

        <form method="post" action="index.php"> <!-- DEBUT DU FORMULAIRE A SEND TO $_POST -->
            <h1 id="jourRes">Réservation</h1>
            <br> <br>
            <div>Sélectionnez vos détails et nous ferons notre possible pour satisfaire votre demande</div> <br> <br><br>

            <?php if (isset($erreur_date)) //Affichages des messages d'erreurs en cas de date invalides (voir ligne 15 à 45)
                        echo '<span>' . $erreur_date . '</span><br />'; ?>
            <?php if (isset($erreur_heure))
                echo '<span>' . $erreur_heure . '</span><br />'; ?>
            <?php if (isset($erreur_couverts))
                echo '<span>' . $erreur_couverts . '</span><br />'; ?>

            <table id="tableIndex">
                <tr id="trIndexLabel">
                    <td id="tdIndex"><label for="date">Date</label></td>
                    <td id="tdIndex"><label for="heures">Heure</label></td>
                    <td id="tdIndex"><label for="couverts">Taille du groupe</label></td>
                </tr>
                <tr id="trIndex">
                    <!-- DATE ENTRY($annee $mois $jour)----------------------------------------------------------------------->
                <td id="tdIndex"><input type="date" name="date" value="<?php if (isset($date))
                    echo $date; ?>" required /></td>

                <!-- HEURE ENTRY ($heures N"EXISTE PLUS: $minutes)----------------------------------------------------------------------->
                <td id="tdIndex">
                    <select name="heures">
                        <option value="11:30" <?php if (isset($heures) && $heures == '11:30')
                            echo 'selected'; ?>>11:30
                        </option>
                        <option value="12:00" <?php if (isset($heures) && $heures == '12:00')
                            echo 'selected'; ?>>12:00
                        </option>
                        <option value="12:30" <?php if (isset($heures) && $heures == '12:30')
                            echo 'selected'; ?>>12:30
                        </option>
                        <option value="13:00" <?php if (isset($heures) && $heures == '13:00')
                            echo 'selected'; ?>>13:00
                        </option>
                        <option value="19:30" <?php if (isset($heures) && $heures == '19:30')
                            echo 'selected'; ?>>19:30
                        </option>
                        <option value="20:00" <?php if (isset($heures) && $heures == '20:00')
                            echo 'selected'; ?>>20:00
                        </option>
                        <option value="20:30" <?php if (isset($heures) && $heures == '20:30')
                            echo 'selected'; ?>>20:30</option>
                        <option value="21:00" <?php if (isset($heures) && $heures == '21:00')
                            echo 'selected'; ?>>21:00</option>
                        <option value="21:30" <?php if (isset($heures) && $heures == '21:30')
                            echo 'selected'; ?>>21:30</option>
                    </select>
                </td>

                <!-- $COUVERT ENTRY----------------------------------------------------------------------->
                <td id="tdIndex"> <select name="couverts">
                        <option value="4" <?php if (isset($couverts) && $couverts == '4')
                            echo 'selected'; ?>>4 personnes
                        </option>
                        <option value="5" <?php if (isset($couverts) && $couverts == '5')
                            echo 'selected'; ?>>5 personnes
                        </option>
                        <option value="6" <?php if (isset($couverts) && $couverts == '6')
                            echo 'selected'; ?>>6 personnes
                        </option>
                        <option value="7" <?php if (isset($couverts) && $couverts == '7')
                            echo 'selected'; ?>>7 personnes
                        </option>
                        <option value="8" <?php if (isset($couverts) && $couverts == '8')
                            echo 'selected'; ?>>8 personnes
                        </option>
                        <option value="9" <?php if (isset($couverts) && $couverts == '9')
                            echo 'selected'; ?>>9 personnes
                        </option>
                        <option value="10" <?php if (isset($couverts) && $couverts == '10')
                            echo 'selected'; ?>>10 personnes
                            et plus
                        </option>
                    </select>
                </td>
            </tr>
        </table>
        <br><br>
        <h1 id=infoSup>Informations complémentaires</h1>
        <?php if (isset($erreur_nom)) //affichage des messages d'erreurs...
                    echo '<span>' . $erreur_nom . '</span><br />'; ?>
        <?php if (isset($erreur_email))
            echo '<span>' . $erreur_email . '</span><br />'; ?>
        <!-- $NOM ENTRY----------------------------------------------------------------------->
        <label for="nom">Nom</label><br />
        <input type="text" name="nom" placeholder="Exemple : Jean Dupont" value="<?php if (isset($nom))
            echo $nom; ?>" /><br />
        <!-- $EMAIL ENTRY----------------------------------------------------------------------->
        <label for="email">Courriel</label><br />
        <input type="text" name="email" placeholder="Exemple : jeandupont@gmail.com" value="<?php if (isset($email))
            echo $email; ?>" /><br />
        <input type="submit" value="RÉSERVER" />
    </form>
    <?php } ?>
</body>

</html>