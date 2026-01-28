<?php $title="Forum";
ob_start() ?>

<main>
    <section class="heading">
        <h2>Forum</h2>
    </section>
    <section class="ForumCore">
        <?php 
        foreach ($threads as $thread) {?>
            <div class="thread">
                <h3>
                    <?= htmlspecialchars($thread->title); ?>
                </h3>
                <div class="threadPreview">
                    <?= htmlspecialchars($thread->content); ?>
                </div>
                <div class="threadDetail">
                    <span class="threadCreatedBy"><?= htmlspecialchars($thread->created_by); ?></span>
                    <span class="threadCreatedAt"><?= htmlspecialchars($thread->created_at); ?></span>
                    <span class="threadLastUpdate"><?= htmlspecialchars($thread->last_update); ?></span>
                </div>
            </div>
        <?php    
        }?>
    </section>
    
</main>

<?php $content = ob_get_clean(); ?>
<?php require __DIR__ . '/../layout.php' ?>