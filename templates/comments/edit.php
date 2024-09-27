<?php include_once __DIR__ . '/../header.php' ?>

<div class="edit-form">
    <?php if (!empty($error)): ?>
        <div class="error-container">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php elseif (!empty($successfully)): ?>
        <div class="successfully-container">
            <?= htmlspecialchars($successfully) ?>
        </div>
    <?php endif; ?>
    <form action="/comments/<?= $comment->getId() ?>/edit" method="post">
        <div class="form-group">
            <label for="comment" style="text-align: center">Ваш комментарий</label>
            <textarea class="form-control" name="comment" id="comment" rows="10"
                      cols="80"><?= htmlspecialchars($_POST['comment'] ?? $comment->getComment()) ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Изменить</button>
        <br>
        <a style="width: 300px" href="/comments/<?= $comment->getId() ?>/delete"
           class="btn btn-danger">Удалить</a><br>
    </form>
</div>

<?php include_once __DIR__ . '/../footer.php' ?>
