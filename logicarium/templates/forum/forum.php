<?php $title="Forum";
ob_start() ?>

<main>
    <section class="heading">
        <h2>Forum</h2>
        <div class="breadCrumb">
            test/test/test
        </div>
    </section>
    <section class="ForumCore">
        <?php 
        foreach ($threads as $thread) {?>
            <div class="thread">
                <div class="thread_left">
                    <h3 class="thread_left_top">
                        <?= htmlspecialchars($thread->title); ?>
                    </h3>
                    <div class="threadPreview">
                        <?= htmlspecialchars($thread->content); ?>
                    </div>
                </div>
                <div class="threadDetail">
                    <span class="threadLabelCreatedBy">Créer par </span>
                    <span class="threadCreatedBy"> <?= htmlspecialchars($thread->created_by); ?></span>
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
    
</main>

<?php $content = ob_get_clean(); ?>
<?php require __DIR__ . '/../layout.php' ?>