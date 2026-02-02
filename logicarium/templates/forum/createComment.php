<?php $title="Nouveau Commentaire";
ob_start() ?>

<form action="index.php?action=submitCreateComment" method="post" class="formCreateComment" >
    <input type="hidden" id="thread_id" name="thread_id" value=<?= $thread_id ?>>
    <div class="labelCell" id="formCreateCommentContentLabel">
        <h6>Content</h6>
    </div>
    <div id="formCreateThreadContent" class="formInputArea">    
        <label for="content"></label>
        <textarea name="content" id="content" required></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Créer le Commentaire</button>
</form>

<?php $content = ob_get_clean(); ?>
<?php require __DIR__ . '/../common/layout.php' ?>