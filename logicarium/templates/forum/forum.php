<?php $title="Forum";
ob_start() ?>

<section class="heading">
    <h2>Forum</h2>
    <div class="breadCrumb">
        test/test/test
    </div>
    <div class="forumBoutonContainer">
        <?php if(isset($_SESSION['logged']) && $_SESSION['logged']) :?>
        <a class="forumBouton" href="index.php?action=createNewThread">Nouveau fil</a>
        <?php endif ?>
    </div>
</section>
<section class="forumCore">
    <?php 
    foreach ($threads as $thread) {?>
        <div class="thread">
            <div class="threadLeft">
                <h3 class="threadLeftTop">
                    <a href="index.php?action=thread&thread_id=<?= $thread->id ?>"><?= htmlspecialchars(substr($thread->title,0,70)); ?></a>
                </h3>
                <div class="threadDescription">
                    <?= htmlspecialchars(substr($thread->description,0,70)); ?>
                </div>
            </div>
            <div class="threadDetail">
                <span class="threadLabelCreatedBy">Créer par </span>
                <span class="threadCreatedBy"> <?= htmlspecialchars(substr($thread->created_by, 0, 15)); ?></span>
                <span class="threadCreatedAt"> Le <?= htmlspecialchars($thread->created_at); ?></span>

                <?php if($thread->last_answer): ?>                    
                    <span class="threadLabelLastAnswer">Dernière réponse </span>
                    <span class="threadLastAnswer"><?=
                    htmlspecialchars($thread->last_answer)?></span>
                    <?php else: ?>
                    <span class="threadLastAnswer">Aucune réponse</span>
                <?php endif ?>

                <span class="threadLastUpdate"><?= htmlspecialchars($thread->last_update); ?></span>
            </div>
        </div>
    <?php    
    }?>
</section>

<?php $content = ob_get_clean(); ?>
<?php require __DIR__ . '/../layout.php' ?>