<?php $title="Forum";
ob_start() ?>

<main>
    <section class="heading">

    </section>
    <section class="ForumCore">
        <?php 
        foreach ($threads as $thread) {?>
            <div class="thread">
                <h3>
                    <?= htmlspecialchars($thread->title); ?>
                </h3>
                <div class="threadDetail">
                     <?= $thread->creation_date ?>
                </div>
            </div>
        <?php    
        }?>
    </section>
    <h2>Forum</h2>
</main>

<?php $content = ob_get_clean(); ?>
<?php require __DIR__ . '/../layout.php' ?>