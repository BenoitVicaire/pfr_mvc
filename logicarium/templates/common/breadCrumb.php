<?php ob_start(); ?>

<nav aria-label="Breadcrumb" class="breadcrumb">
    <ol>
        <li><a href="#">Accueil</a></li>
        <li><a href="#">Forum</a></li>
        <li><span aria-current="page">Thread</span></li>
    </ol>
</nav>

<?php $breadCrumbDisplay = ob_get_clean(); 

?>
