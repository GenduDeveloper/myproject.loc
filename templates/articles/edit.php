<?php include_once __DIR__ . '/../header.php' ?>

<div class="edit-form">
    <?php if (!empty($error)): ?>
        <div class="error-container">
            <?= $error ?>
        </div>
    <?php endif; ?>
    <form action="/articles/<?= $article->getId() ?>/edit" method="post">
        <div class="form-group">
            <label for="name">Название статьи</label>
            <input type="text" class="form-control wide-input" id="name" name="name"
                   value="<?= htmlspecialchars($_POST['name'] ?? $article->getName(), ENT_QUOTES, 'UTF-8') ?>">
        </div>
        <div class="form-group">
            <label for="text">Текст статьи</label>
            <textarea class="form-control" name="text" id="text" rows="10"
                      cols="80"><?= htmlspecialchars($_POST['text'] ?? $article->getText(), ENT_QUOTES, 'UTF-8') ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Редактировать</button>
        <br>
        <div class="form-group">
            <a style="width: 300px" href="/articles/<?= $article->getId() ?>/delete"
                                   class="btn btn-danger">Удалить</a>
        </div>
    </form>
</div>

<?php include_once __DIR__ . '/../footer.php' ?>
