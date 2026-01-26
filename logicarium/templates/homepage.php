<?php $title = "Logicarium";

ob_start(); ?>

<main>
    <section class="article_column">
        <div class="article">
            <h2 id="article1_title">Discover our new game: Protect the Dungeon</h2>
            <img src="assets/videos/video-placeholder.jpg" alt="Trailler of Protect The Dungeon">
            <p id="article1_text">A new adventure begins: a horde of monsters wants to eat your fellow citizens, protect your colleagues by erecting an impenetrable defense!</p>
        </div>
        <div class="article">
            <h2 id="article2_title">Discover our new game: Protect the Dungeon</h2>
            <img src="assets/videos/video-placeholder.jpg" alt="Trailler of Protect The Dungeon">
            <p id="article2_text">A new adventure begins: a horde of monsters wants to eat your fellow citizens, protect your colleagues by erecting an impenetrable defense!</p>
        </div>
        <div class="article">
            <h2 id="article3_title">Discover our new game: Protect the Dungeon</h2>
            <img src="assets/videos/video-placeholder.jpg" alt="Trailler of Protect The Dungeon">
            <p id="article3_text">A new adventure begins: a horde of monsters wants to eat your fellow citizens, protect your colleagues by erecting an impenetrable defense!</p>
        </div>
    </section>
</main>

<?php $content = ob_get_clean(); ?>
<?php require('layout.php') ?>