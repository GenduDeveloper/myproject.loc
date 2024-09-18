<?php include_once __DIR__ . '/../header.php' ?>

<article>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <p><?= $article->getText() ?></p>
                <p class="post-meta"><strong>Автор статьи:</strong> <?= $article->getAuthor()->getNickname() ?>.</p>
                <?php if ($user !== null && $user->isAdmin()): ?>
                    <a style="width: 300px" href="/articles/<?= $article->getId() ?>/edit"
                       class="btn btn-primary">Редактировать</a><br><br>
                    <a style="width: 300px" href="/articles/<?= $article->getId() ?>/delete"
                       class="btn btn-danger">Удалить</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</article>
<hr>

<?php include_once __DIR__ . '/../footer.php' ?>


