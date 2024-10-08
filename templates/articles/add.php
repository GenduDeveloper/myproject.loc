<?php include_once __DIR__ . '/../header.php' ?>

<div class="add-form">
    <?php if (!empty($error)): ?>
        <div class="error-container">
            <?= $error ?>
        </div>
    <?php endif; ?>
    <form action="/articles/add" method="post">
        <div class="form-group">
            <label for="name">Название статьи</label>
            <input type="text" class="form-control" placeholder="Название статьи" id="name" name="name"
                   value="<?= $_POST['name'] ?? '' ?>">
        </div>
        <div class="form-group">
            <label for="text">Текст статьи</label>
            <textarea class="form-control" name="text" id="text" rows="10"
                      cols="80"><?= $_POST['text'] ?? '' ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Создать</button>
    </form>
</div>

<?php include_once __DIR__ . '/../footer.php' ?>
