<?php $title=$thread->getTitle();
$page="thread";
ob_start() ?>
                        <!-- Partie thread -->
        <!-- Titre du thread -->
    <header class="threadHeader">
        <h1 class="threadTitle"><?= $thread->getTitle() ?></h1>
        <a href="index.php?action=createComment&thread_id=<?= $thread->getId() ?>">Commenter</a>
    </header>
    
    <section class="threadBody">
        <!-- Contenu du thread -->
        <div class="threadContent">
            <p><?= $thread->getContent() ?></p>
        </div>
        <!-- Detail du createur du thread -->
        <div class="userDetail">
            <img src=<?= $thread->getAvatarUrl() ?> alt=<?= $thread->getAvatarName() ?>>
            <span class="threadAuthor">par <?= $thread->getCreatedByName() ?></span>

            <time datetime="2025-01-28">Le <?= $thread->getCreatedAt() ?></time>
        </div>
    </section>
</article>
                        <!-- Partie commentaire -->
<section class="comments">
    <?php foreach($comments as $comment){ ?>
        <article class="comment">
            <section class="commentBody">
                <!-- Contenu du commentaire -->
                <div class="commentContent">
                    <p><?= $comment->getContent() ?></p>
                </div>
                <!-- Detail du createur du thread -->
                <div class="userDetail">
                    <img src="/pfr_mvc/logicarium/public/assets/images/avatar/Avatar_1.png" alt="avatar1">
                    <span class="threadAuthor">par <?= $comment->getCreatedByName() ?></span>

                    <time datetime="2025-01-28">Le <?= $comment->getCreatedAt() ?></time>
                </div>
            </section>
        </article>
    <?php } ?>
</section>

<?php $content = ob_get_clean(); ?>
<?php require __DIR__ . '/../common/layout.php' ?>