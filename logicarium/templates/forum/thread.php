<?php $title=$thread->title;
$page="thread";
ob_start() ?>
                        <!-- Partie thread -->
<article class="thread">
        <!-- Titre du thread -->
    <header class="threadHeader">
        <h1 class="threadTitle"><?= $thread->title ?></h1>
        <a href="index.php?action=createComment&thread_id=<?= $thread->id ?>">Commenter</a>
    </header>
    
    <section class="threadBody">
        <!-- Contenu du thread -->
        <div class="threadContent">
            <p><?= $thread->content ?></p>
        </div>
        <!-- Detail du createur du thread -->
        <div class="userDetail">
            <img src="/pfr_new/logicarium/public/assets/images/avatar/Avatar_1.png" alt="avatar1">
            <span class="threadAuthor">par <?= $thread->created_by ?></span>

            <time datetime="2025-01-28">Le <?= $thread->created_at ?></time>
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
                    <p><?= $comment->content ?></p>
                </div>
                <!-- Detail du createur du thread -->
                <div class="userDetail">
                    <img src="/pfr_new/logicarium/public/assets/images/avatar/Avatar_1.png" alt="avatar1">
                    <span class="threadAuthor">par <?= $comment->created_by ?></span>

                    <time datetime="2025-01-28">Le <?= $comment->created_at ?></time>
                </div>
            </section>
        </article>
    <?php } ?>
</section>

<?php $content = ob_get_clean(); ?>
<?php require __DIR__ . '/../common/layout.php' ?>