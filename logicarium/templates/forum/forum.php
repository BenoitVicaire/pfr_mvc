<?php $title="Forum";
ob_start() ?>

<main>
    <h2>Forum</h2>
</main>

<?php $content = ob_get_clean(); ?>
<?php require __DIR__ . '/../layout.php' ?>