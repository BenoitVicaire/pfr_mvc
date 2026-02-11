<?php $title="Forum";
$page = 'forum';
$breadcrumb=true;

ob_start() ?>

<div class="forum">
    <section class="heading">
        <h2>Forum</h2>
        
        <div class="forumBoutonContainer">
            <?php if(isset($_SESSION['logged']) && $_SESSION['logged']) :?>
                <a class="forumBouton" href="index.php?action=createNewThread">Nouveau fil</a>
            <?php else : ?> <a href="index.php?action=login">Connectez vous pour poster un thread</a>
            <?php endif ?>
        </div>
    </section>
    <section class="forumCore">
        <?php 
        foreach ($categories as $category) { ?>
            <div class="collapsible">
                <div class="category">
                    <h2 class="category-title" data-category-id="<?= $category->getId() ?>">
                        <?= htmlspecialchars($category->getName()) ?>
                        <span class="arrow">▾</span>
                    <p><?= htmlspecialchars($category->getDescription()) ?></p>
                </div>

                    <?php $categoryThreads = $threadsByCategory[$category->getId()]['threads'] ?? []; ?>
                    <?php if (!empty($categoryThreads)){ ?>
                        <?php foreach ($categoryThreads as $thread){ ?>
                            <section class="thread">
                                <div class="threadLeft">
                                    <h3 class="threadLeftTop">
                                        <a href="index.php?action=thread&thread_id=<?= $thread->getId() ?>"><?= htmlspecialchars(substr($thread->getTitle(),0,70)); ?></a>
                                        
                                    </h3>
                                    
                                    <div class="threadDescription">
                                        <?= htmlspecialchars(substr($thread->getDescription(),0,70)); ?>
                                    </div>
                                </div>
                                
                                <div class="threadDetail">
                                    <span class="threadLabelCreatedBy">Créer par </span>
                                    <span class="threadCreatedBy"> <?= htmlspecialchars(substr($thread->getCreatedByName(), 0, 15)); ?></span>
                                    <span class="threadCreatedAt"> Le <?= htmlspecialchars($thread->getCreatedAt()); ?></span>

                                    <?php if($thread->getLastAnswer()): ?>                    
                                        <span class="threadLabelLastAnswer">Dernière réponse </span>
                                        <span class="threadLastAnswer"><?=
                                        htmlspecialchars($thread->getLastAnswer())?></span>
                                        <?php else: ?>
                                        <span class="threadLastAnswer">Aucune réponse</span>
                                    <?php endif ?>

                                    <span class="threadLastUpdate"><?= htmlspecialchars($thread->getLastUpdate()); ?></span>
                                </div>
                            </section> 
                        <?php 
                        }; 
                    };
            ?></div><?php
        }?>
    </section>
</div>

<?php $content = ob_get_clean(); ?>
