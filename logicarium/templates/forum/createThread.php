<?php $title="Nouveau Thread";
ob_start() ?>

<form action="index.php?action=submitCreateThread" method="post" class="formCreateThread" >
    <div id="formCreateThreadCategory" class="formInputArea">
        <select name="category_id" id="categorieSelect" required>
                <option value="">--Veuillez choisir une catégorie</option>
            <?php foreach ($categories as $category){ ?>
                <option value=<?= $category->id ?>><?= $category->name ?></option>
            <?php } ?> 
        </select>
    </div>

    <div class="labelCell" id="formCreateThreadTitleLabel">
        <h6>Title</h6>
    </div>
    <div id="formCreateThreadTitle" class="formInputArea">
        <label for="title"></label>
        <input type="text" name="title" id="title" required>
    </div>

    <div class="labelCell" id="formCreateThreadDescriptionLabel">
        <h6>Description</h6>
    </div>
    <div id="formCreateThreadDescription" class="formInputArea">
        <label for="description"></label>
        <textarea name="description" id="description" required></textarea>
    </div>

    <div class="labelCell" id="formCreateThreadContentLabel">
        <h6>Content</h6>
    </div>
    <div id="formCreateThreadContent" class="formInputArea">    
        <label for="content"></label>
        <textarea name="content" id="content" required></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Créer le thread</button>
</form>



<?php $content = ob_get_clean(); ?>
<?php require __DIR__ . '/../common/layout.php' ?>