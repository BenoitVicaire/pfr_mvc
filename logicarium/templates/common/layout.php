<?php 
require('header.php');
require('footer.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Découvrez le Logicarium! un site compilant des jeux basé sur la logique!">
    <title><?= $title ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700;900&family=MedievalSharp&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../public/styles/style.css">
    <link rel="icon" href="../public/assets/icons/gearIcon.svg">
    <script type="module" src="../public/js/main.js"></script>
</head>
<body data-page="<?= $page ?? '' ?>">
    <?= $header ?>
    <main>
        <?= $content ?>
    </main>
    <?= $footer ?>
</body>
</html>