<?php $title=$thread->title;
ob_start() ?>

<div class="threadTitle">
    Titre
</div>
<div class="threadCore">
    Le contenu
</div>
<div class="userDetail">
    
</div>


<?php $content = ob_get_clean(); ?>
<?php require __DIR__ . '/../layout.php' ?>