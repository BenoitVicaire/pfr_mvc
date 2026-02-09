<?php $title = "Logicarium";

ob_start(); ?>

<section class="article_column">
    <div class="article">
        <h2 id="article1_title" data-i18n="article1_title"></h2>
        <img src="assets/videos/video-placeholder.jpg" alt="Trailler of Protect The Dungeon">
        <p id="article1_text" data-i18n="article1_text"></p>
    </div>
    <div class="article">
        <h2 id="article2_title"data-i18n="article2_title"></h2>
        <img src="assets/videos/video-placeholder.jpg" alt="Trailler of Protect The Dungeon">
        <p id="article2_text"data-i18n="article2_text"></p>
    </div>
    <div class="article">
        <h2 id="article3_title"data-i18n="article3_title"></h2>
        <img src="assets/videos/video-placeholder.jpg" alt="Trailler of Protect The Dungeon">
        <p id="article3_text"data-i18n="article3_text"></p>
    </div>
</section>

<?php $content = ob_get_clean(); ?>
<?php require('common/layout.php') ?>