<?php $title = "Erreur"; ?>

<?php ob_start(); ?>
<div class="errorContainer">
    <p>Une erreur est survenue : <?= $errorMessage ?></p>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>
