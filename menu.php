<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <title>Menu du restaurant</title>
</head>

<body>
    <div id="logo">
        <a href="accueil.html">
            <img src="./img/Favicon_edited.png.webp" alt="logo" style="max-width: 100%; height: auto;">
        </a>
    </div>
    <a href="index.php">Réservez maintenant !</a>
    <section class="menu">
        <?php
        $menu = fopen('backoffice/menu.txt', 'r');
        while ($ligne = fgets($menu))
            echo $ligne;
        fclose($menu);
        ?>
    </section>
</body>

</html>